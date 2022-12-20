<?php

namespace App\Http\Controllers;

use App\Commands\CreateArticleCommand;
use App\Commands\Validators\CreateArticleValidator;
use App\Handlers\CreateArticleHandler;
use Illuminate\Http\Request;
use App\Models\Article;
use Joselfonseca\LaravelTactician\CommandBusInterface;

class ArticleController extends Controller
{
    /** @var CommandBusInterface $commandBus */
    protected $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        // Command bus design pattern
        $this->commandBus =$commandBus;
    }

    public function index(){
        return Article::all();
    }

    public function show($id){
        return Article::find($id);
    }

    public function store(Request $request){

        // Thêm handler cho command
        $this->commandBus->addHandler(CreateArticleCommand::class, CreateArticleHandler::class);

        $createArticleCommand = new CreateArticleCommand($request->input('title'), $request->input('body'));

        // Dispatch command CreateArticleCommand
        $article = $this->commandBus->dispatch(
            $createArticleCommand,
            [],
            [CreateArticleValidator::class]
        );

        return response()->json($article, 201); // 201 - Created
    }

    public function update(Request $request, $id){
        $article = Article::findOrFail($id);
        $article->update($request->all());
        return response()->json($article, 200); // 200 - OK success
    }

    public function delete(Article $article){
        $article->delete();
        return response()->json(null, 204);
    }
}
