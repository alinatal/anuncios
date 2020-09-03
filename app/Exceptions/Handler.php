<?php

namespace App\Exceptions;

use App\Ad;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list.blade.php of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list.blade.php of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if(get_class($exception) == "Illuminate\Database\Eloquent\ModelNotFoundException" && $exception->getModel() == ('App\Ad')) {
            $columns = ['name','description'];
            $string = $exception->getIds()[0];
            $string = str_replace('-', ' ', $string);

            $words_search = explode(" ", $string);
            $ads = Ad::from('ads as a')
                ->where(function ($query) use ($columns, $words_search) {
                    foreach ($words_search as $word) {
                        $query = $query->where(function ($query) use ($columns,$word) {
                            foreach ($columns as $column) {
                                $query->orWhere($column,'like',"%$word%");
                            }
                        });
                    }
                })->paginate(10)/*->limit(15)*/;



            return (new Response(view('search')
                ->withAds($ads)
                ->withSearch($string)
                ->withMessage('<strong>ERROR 404</strong>: El anuncio que has seguido ya no existe. A continuación te dejamos algunos anuncios que te podrían interesar.'),
                404));
        }
            return parent::render($request, $exception);
    }
}
