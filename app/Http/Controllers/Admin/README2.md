Per creare un controller classico il comando da lanciare è: 

php artisan make:controller Admin/HomeController 

Per creare un controller risorsa il comando da lancaire è (con dentro tutte le CRUD):

php artisan make:controller Admin/PostController -r.

Per richiamarlo bisogna andare in web.php e inserire la rotta: 

Laravel ci mette a disposizione una cosa molto comoda per gestire in modo univoco, in gruppo tutte le rotte che fanno parte dello stesso "argomento", quindi se volessimo raggruppare tutte le rotte che sono soggette ad autenticazione possiamo usare il ::group


Route::middleware('auth')
    ->prefix('admin') <!--Ha effetto sul percorso-->
    ->name('admin.')  <!--Ha effetto sul name-->
    ->namespace('Admin') <!--Gestisce il path-->
    ->group(function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('posts','PostController');
});


Route::get('{any?}', function(){
    return view('guest.home');
})->where("any", ".*");

Con questa sintassi gli diciamo qualcunque valore anche opzionale porta a guest.home.


Con questa sintassi gli stiamo dicendo, tutte queste rotte sono soggette a middleware.
Possiamo aggiungere un name, cosi facendo tutte le rotte che aggiungamo qui devono iniziare tutte per /admin. Invece aggiungendo anche prefix abbiamo la possibilità di rendere più semplice la sintassi.
Come namespace invece intendiamo  Route::get('/admin',). Lui intende il percorso, cosi facendo non abbiamo bisogno di scrivere le rotte accanto al nome del controller.



<h1>Route::has
<!--Home http://127.0.0.1:8000/-->
</h1>

<p>
@if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
@endif

Route::has('login') controlla se tra le rotte c'è una che centra con login

@auth è un comando blade che controlla se sei loggato o no quindi se si mostra un tipo specifico di pagina, altrimenti se non siamo loggati vengono mostrati altri tipi di controlli (login-register)



<h1>
VUE
</h1>
<p>
Per inserire vue dobbiamo scrivere in home:

<div id="root">

</div>

Per dividere front-end e back-end (VUE) dobbiamo creare un nuovo file dentro la cartella resources/js/"nome file" copiando direttamente il file precedente "app.js", lo rinominiamo con front.js e questo avrà soltanto la parte di vue mentre app.js avrà soltanto la parte di bootstrap.


<!--app.js:



require('./bootstrap');-->


<!--front.js:

window.Vue = require('vue');

import App from './components/App.vue';

const root = new Vue ({
    el:'#root',
    render: h => h(app)
});-->



Il successivo passaggio sarà compilare front.js con webpack. Per farlo andiamo in 
webpack.mix.js e compiliamolo in questo modo:

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/front.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css'); 


Cosi facendo abbiamo un file che possiamo richiamare nella pagina o nelle view o nel front e soltanto quelle pagine potranno usare VUE.


Successivamente andiamo in home.blade.php e inseriamo lo script:

<script src=" {{ asset ( 'js/front.js' )}} "></script>



Ora per andare ad inserire il contenuto dinamico andiamo in App.vue e cancelliamo:
export default {
        mounted() {
            console.log('Component mounted.')
        }
    } all'intento di script e scriviamo name:"App"; e lanciamo npm run watch/dev


Invece avessimo anche un altro componente all'interno, lo creiamo nella cartella dove si trova anche App.vue e lo chiamiamo (per esempio) Header.vue. In quest'ultimo componente scriviamo:

<template>
    <header>
        <h1>Benvenuuuuti</h1>
    </header>
</template>


<script>
export default{
    name:"header"
}

</script>

mentre in App.vue aggiungiamo in script:

import Header from './Header.vue';
export default{
    name:"App",
    components:{
        Header
    }
} 

e nel template ecc aggiungiamo <Header/>
</p>



Creare una tabella con Blade/Laravel

Per creare contemporaneamente model e migration:

php artisan make:model Models/nomedelmodelloalsingolare -m

Successivamente andiamo in database/migrations/e il nome della migration creata e aggiuamo le varie colonne alla tabella: Es.:

<!--public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('image');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }
-->


L'utilizzo di slug: Cos'è uno slug? 
Risposta: Rende tutto minuscolo e aggiunge i trattini.


Per migrate questa tabella utilizziamo : 
php artisan migrate 

ora possiamo andare ad utlizzare un seeder: 

Per creare un seeder lanciamo
php artisan make:seeder PostSeeder

Dopo che il processo è andato a buon fine possiamo anche utlizzare i faker.
Prima di tutto dobbiamo importare in PostSeeder il model quindi dobbiamo scrivere:

use App\Models\Post

Per importare i faker invece:

```
composer remove fzaninotto/faker
composer require fakerphp/faker
```
Successivamente bisognerà importarlo con lo use:
use Faker\Generator as Faker;


In run dobbiamo aggiungere run(Faker $faker) e nelle parentesi graffe scivere un ciclo for:


public function run(Faker $faker)
    {
        for($i = 0; $i < 10; $i++){
            $post = new Post();
            $post->title = $faker->text();
            $post->content = $faker->paragraph(2);
            $post->image = $faker->imageUrl(250, 250);
            $post->slug = Str::slug( $post->title, '-');
            $post->save();
        }
    }

Per quanto riguarda lo slug bisogna sempre importarlo con: Use Illuminate\Support\Str.

A questo punto possiamo passare ai Seeder e andare in DatabaseSeeder.php e scommentare il contenuto di run e modificarlo in base al nome del Seeder. 




------------------------------------------------------------------------------------------


Ora dobbiamo passare tutti i dati(faker) alla index. Per poterlo fare dobbiamo andare in PostController e inserire il model: use App\Models\Post;

Avendo inserito un model per richiamare i dati (nella index) si crea una variabile al plurale perché conterra più elementi. Si utilizza il nome del modello con all cosi:

 $posts = Post::all();

return view('admin.posts.index', compact('posts'));


Per noi tutto quello che è CRUD lo inseriamo nelle view ma nella cartella Admin perché questa avrà tutte le view che sono per noi back e che sono gestite tutte dal login. Quindi all'interno di admin dobbiamo creare un'altra cartella che si chiamerà posts e all'interno di questa cartella dobbiamo inserire index.blade.php e Successivamente darla come riferimento. (vedi riga 231)

</p> 