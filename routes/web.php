<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Curator\DashboardController as CuratorDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Member\InteractionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ModerationController;
use App\Http\Controllers\Member\ArtworkController;
use App\Http\Controllers\ChallengeSubmissionController;
use App\Http\Controllers\Member\PublicProfileController;
use App\Http\Controllers\ArtworkInteractionController;
use App\Http\Controllers\CreatorController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Curator\CuratorController;
use App\Http\Controllers\Curator\ChallengeController;
use App\Http\Controllers\Curator\SubmissionController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Member\DashboardController;




/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/artworks/{artwork}', [PublicController::class, 'show'])->name('artworks.show');
Route::get('/profile/{user}', [PublicController::class, 'profile'])->name('profile.show');

Route::get('/challenges', [ChallengeSubmissionController::class, 'index'])->name('challenges.index');

Route::get('/challenges/{challenge}', [PublicController::class, 'challengeShow'])
    ->name('challenges.show');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (LOGIN / REGISTER)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::get('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);


Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

/*
|--------------------------------------------------------------------------
| AUTH REQUIRED – GENERAL
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


     Route::post('/follow/{user}', [\App\Http\Controllers\Member\FollowController::class, 'follow'])->name('member.follow');
    Route::post('/unfollow/{user}', [\App\Http\Controllers\Member\FollowController::class, 'unfollow'])->name('member.unfollow');
    Route::get('/curator/pending', function () {
        $user = auth()->user();
        if ($user->role === 'curator' && $user->status === 'pending') {
            return view('curator.pending');
        }
        return redirect()->route($user->role . '.dashboard');
    })->name('curator.pending');


     Route::get('/member/artworks/submissions', [ArtworkController::class, 'submissions'])
     ->name('member.artworks.submissions');

     Route::delete('/member/artworks/comment/{commentId}', 
    [ArtworkInteractionController::class, 'deleteComment']
)->name('member.artworks.comment.delete');

});

/*
|--------------------------------------------------------------------------
| MEMBER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'member'])->prefix('member')->name('member.')->group(function () {
Route::post('artworks/{artwork}/like', [ArtworkInteractionController::class, 'like'])->name('artworks.like');

Route::post('/member/artworks/{artwork}/like', [InteractionController::class, 'like'])->name('member.artworks.like');
   
     Route::get('dashboard', [App\Http\Controllers\Member\DashboardController::class, 'index'])->name('dashboard');
  
    Route::resource('artworks', ArtworkController::class);

     Route::get('/member/dashboard', [MemberArtworksController::class, 'index'])
    ->name('member.dashboard');



Route::delete('{artwork}/favorite', [InteractionController::class, 'removeFavorite'])->name('unfavorite');

    Route::post('/artworks/{artwork}/favorite', [InteractionController::class, 'favorite'])
        ->name('artworks.favorite');


    Route::post('/artworks/{artwork}/comment', [InteractionController::class, 'comment'])
        ->name('artworks.comment');

    Route::delete('/member/artworks/comment/{comment}', [\App\Http\Controllers\Member\InteractionController::class, 'deleteComment'])
    ->name('member.artworks.comment.delete')
    ->middleware('auth');


    Route::post('/artworks/{artwork}/report', 
    [ArtworkInteractionController::class, 'report']
)->name('artworks.report');


    Route::get('/member/favorites', [ArtworkInteractionController::class, 'showFavorite'])
         ->name('member.favorites');


    Route::get('favorites', [ArtworkInteractionController::class, 'showFavorite'])
        ->name('favorites');

    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');

     Route::delete('/artworks/{artwork}/favorite', [InteractionController::class, 'removeFavorite'])
            ->name('artworks.removeFavorite');


    Route::delete('/artworks/{comment}/comment', [\App\Http\Controllers\Member\InteractionController::class, 'deleteComment'])
        ->name('artworks.comment.delete');

       Route::delete('/artworks/comment/{comment}', [CommentController::class, 'destroy'])
    ->name('artworks.comment.delete')
    ->middleware(['auth']);


    Route::get('/member/{user}/public', [PublicProfileController::class, 'show'])->name('member.public');

    
    Route::get('/artworks/{artwork}', [ArtworkController::class, 'show'])
    ->name('member.artworks.show');
Route::resource('artworks', \App\Http\Controllers\Member\ArtworkController::class);

Route::get('/artworks/{artwork}', [PublicController::class, 'show'])->name('artworks.show');


});


/*
|--------------------------------------------------------------------------
| CURATOR ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'curator'])
    ->prefix('curator')
    ->name('curator.')
    ->group(function () {


    
    Route::post('challenges/{challenge}/announce', [App\Http\Controllers\Curator\ChallengeController::class, 'announceWinners'])
         ->name('challenges.announce');
       
        Route::get('/dashboard', [CuratorController::class, 'dashboard'])->name('dashboard');

     
        Route::resource('challenges', App\Http\Controllers\Curator\ChallengeController::class);

    Route::post('challenges/{challenge}/announce', 
        [App\Http\Controllers\Curator\ChallengeController::class, 'announceWinners'])
        ->name('challenges.announce');
    
        Route::get('challenges/{challenge}/winners', [App\Http\Controllers\Curator\ChallengeController::class, 'selectWinners'])
             ->name('challenges.winners');
        Route::post('challenges/{challenge}/winners', [App\Http\Controllers\Curator\ChallengeController::class, 'storeWinners'])
             ->name('challenges.winners.store');

              Route::get('curator/challenges/{challenge}/winners', [ChallengeController::class, 'selectWinners'])
     ->name('curator.challenges.winners');

     
 
        Route::get('submissions', [App\Http\Controllers\Curator\SubmissionController::class, 'index'])
             ->name('submissions.index');
        Route::post('submissions/{submission}/winner', [App\Http\Controllers\Curator\SubmissionController::class, 'setWinner'])
             ->name('submissions.set_winner');
});

Route::get('/challenges/{challenge}', [ChallengeSubmissionController::class, 'show'])
     ->name('challenges.show');


Route::middleware(['auth', 'member'])->group(function() {
    Route::get('/challenges/{challenge}/submit', [ChallengeSubmissionController::class, 'create'])
         ->name('challenges.submit.form');
    Route::post('/challenges/{challenge}/submit', [ChallengeSubmissionController::class, 'store'])
         ->name('challenges.submit.store');
    Route::get('/members/{user}', [MemberController::class, 'show'])->name('member.profile');

   Route::post('/curator/challenges/{challenge}/announce', 
    [App\Http\Controllers\Curator\ChallengeController::class, 'announceWinners']
)->name('curator.challenges.announce');

    
   
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/statistics', [AdminController::class, 'statistics'])
            ->name('statistics');
     
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)
            ->names([
                'index' => 'categories.index',
                'create' => 'categories.create',
                'store' => 'categories.store',
                'edit' => 'categories.edit',
                'update' => 'categories.update',
                'destroy' => 'categories.destroy',
                'show' => 'categories.show',
            ]);

        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        Route::patch('/users/{user}/approve', [UserController::class, 'approve'])
            ->name('users.approve');

        Route::get('/moderation/queue', [ModerationController::class, 'queue'])->name('moderation.queue');
        Route::post('/moderation/{report}/dismiss', [ModerationController::class, 'dismiss'])->name('moderation.dismiss');
        Route::post('/moderation/{report}/take-down', [ModerationController::class, 'takeDown'])->name('moderation.takeDown');

            
    Route::get('/moderation/queue', [ModerationController::class, 'queue'])
            ->name('moderation.queue');

        Route::post('/moderation/{report}/dismiss', [ModerationController::class, 'dismiss'])
            ->name('moderation.dismiss');

        Route::post('/moderation/{report}/takeDown', [ModerationController::class, 'takeDown'])
            ->name('moderation.takeDown'); 

            
    Route::get('/moderation/{report}/detail', [ModerationController::class, 'detail'])->name('moderation.detail');

    
});

Route::middleware(['auth', 'role:curator'])
    ->prefix('curator')
    ->name('curator.')
    ->group(function () {
        Route::post('challenges/{challenge}/announce', 
            [App\Http\Controllers\Curator\ChallengeController::class, 'announceWinners'])
            ->name('challenges.announce');

        Route::get('/dashboard', [CuratorController::class, 'dashboard'])->name('dashboard');
        Route::resource('challenges', App\Http\Controllers\Curator\ChallengeController::class);
    });

    

require __DIR__.'/auth.php';
