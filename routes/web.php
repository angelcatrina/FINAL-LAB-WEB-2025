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




/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/artworks/{artwork}', [PublicController::class, 'show'])->name('artworks.show');
Route::get('/profile/{user}', [PublicController::class, 'profile'])->name('profile.show');
// Daftar challenge aktif
Route::get('/challenges', [ChallengeSubmissionController::class, 'index'])->name('challenges.index');

// Detail challenge
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

// REGISTER hanya Member & Curator
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
    // Curator pending screen
    Route::get('/curator/pending', function () {
        $user = auth()->user();
        if ($user->role === 'curator' && $user->status === 'pending') {
            return view('curator.pending');
        }
        return redirect()->route($user->role . '.dashboard');
    })->name('curator.pending');


     Route::get('/member/artworks/submissions', [ArtworkController::class, 'submissions'])
     ->name('member.artworks.submissions');


});

/*
|--------------------------------------------------------------------------
| MEMBER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'member'])->prefix('member')->name('member.')->group(function () {

    // Dashboard
     Route::get('dashboard', [App\Http\Controllers\Member\DashboardController::class, 'index'])->name('dashboard');
    // CRUD Artworks
    Route::resource('artworks', ArtworkController::class);

    // Like / Unlike
Route::post('{artwork}/like', [ArtworkController::class, 'like'])->name('like');
Route::delete('{artwork}/like', [ArtworkController::class, 'unlike'])->name('unlike');



Route::delete('{artwork}/like', [InteractionController::class, 'unlike'])->name('unlike'); 
Route::delete('{artwork}/favorite', [InteractionController::class, 'removeFavorite'])->name('unfavorite');
    // Favorite / Unfavorite
    Route::post('/artworks/{artwork}/favorite', [InteractionController::class, 'favorite'])
        ->name('artworks.favorite');

    // Comment
    Route::post('/artworks/{artwork}/comment', [InteractionController::class, 'comment'])
        ->name('artworks.comment');

    Route::delete('/comments/{comment}', [InteractionController::class, 'deleteComment'])
        ->name('comments.delete');

    // Report Artwork
    Route::post('/artworks/{artwork}/report', 
    [ArtworkInteractionController::class, 'report']
)->name('artworks.report');



     // Route untuk menampilkan halaman favorit
    Route::get('/member/favorites', [ArtworkInteractionController::class, 'showFavorite'])
         ->name('member.favorites');

//     // Favorite Page
    Route::get('favorites', [ArtworkInteractionController::class, 'showFavorite'])
        ->name('favorites');
//  Route::post('artwork/{id}/favorite', [ArtworkInteractionController::class, 'toggleFavorite'])->name('artwork.favorite');
    // Profile
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');

     Route::delete('/artworks/{artwork}/favorite', [InteractionController::class, 'removeFavorite'])
            ->name('artworks.removeFavorite');

    // Route untuk hapus komentar
    Route::delete('/artworks/{comment}/comment', [\App\Http\Controllers\Member\InteractionController::class, 'deleteComment'])
        ->name('artworks.comment.delete');

    // Route::get('/member/{user}/public', [MemberController::class, 'public'])->name('member.public');

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


        // Challenge announce
    Route::post('challenges/{challenge}/announce', [App\Http\Controllers\Curator\ChallengeController::class, 'announceWinners'])
         ->name('challenges.announce');
        // Dashboard
        Route::get('/dashboard', [CuratorController::class, 'dashboard'])->name('dashboard');

        // Challenge management (Curator)
        Route::resource('challenges', App\Http\Controllers\Curator\ChallengeController::class);

    Route::post('challenges/{challenge}/announce', 
        [App\Http\Controllers\Curator\ChallengeController::class, 'announceWinners'])
        ->name('challenges.announce');
        // Pilih pemenang (Curator)
        Route::get('challenges/{challenge}/winners', [App\Http\Controllers\Curator\ChallengeController::class, 'selectWinners'])
             ->name('challenges.winners');
        Route::post('challenges/{challenge}/winners', [App\Http\Controllers\Curator\ChallengeController::class, 'storeWinners'])
             ->name('challenges.winners.store');

              Route::get('curator/challenges/{challenge}/winners', [ChallengeController::class, 'selectWinners'])
     ->name('curator.challenges.winners');

     
        // Submissions
        Route::get('submissions', [App\Http\Controllers\Curator\SubmissionController::class, 'index'])
             ->name('submissions.index');
        Route::post('submissions/{submission}/winner', [App\Http\Controllers\Curator\SubmissionController::class, 'setWinner'])
             ->name('submissions.set_winner');
});
// Halaman detail challenge (Guest + Member)
Route::get('/challenges/{challenge}', [ChallengeSubmissionController::class, 'show'])
     ->name('challenges.show');

// Submit karya (Member)
Route::middleware(['auth', 'member'])->group(function() {
    Route::get('/challenges/{challenge}/submit', [ChallengeSubmissionController::class, 'create'])
         ->name('challenges.submit.form');
    Route::post('/challenges/{challenge}/submit', [ChallengeSubmissionController::class, 'store'])
         ->name('challenges.submit.store');
    Route::get('/members/{user}', [MemberController::class, 'show'])->name('member.profile');

   
    
   
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

            // Route statistics
        Route::get('/statistics', [AdminController::class, 'statistics'])
            ->name('statistics');
        // Category Management (resource route)
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

        // User Management
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        Route::patch('/users/{user}/approve', [UserController::class, 'approve'])
            ->name('users.approve');

        // Content Moderation
        Route::get('/moderation/queue', [ModerationController::class, 'queue'])->name('moderation.queue');
        Route::post('/moderation/{report}/dismiss', [ModerationController::class, 'dismiss'])->name('moderation.dismiss');
        Route::post('/moderation/{report}/take-down', [ModerationController::class, 'takeDown'])->name('moderation.takeDown');

            // Content Moderation
    Route::get('/moderation/queue', [ModerationController::class, 'queue'])
            ->name('moderation.queue');

        Route::post('/moderation/{report}/dismiss', [ModerationController::class, 'dismiss'])
            ->name('moderation.dismiss');

        Route::post('/moderation/{report}/takeDown', [ModerationController::class, 'takeDown'])
            ->name('moderation.takeDown'); // gunakan dot bukan dash

            // Detail laporan
    Route::get('/moderation/{report}/detail', [ModerationController::class, 'detail'])->name('moderation.detail');

    
});




    // User Management
    // Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    // Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

//     // Category Management
//     Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
//     Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
//     Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
//     Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
//     Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
//     Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

//     // Content Moderation
//     Route::get('/moderation/queue', [ModerationController::class, 'queue'])->name('admin.moderation.queue');
//     Route::post('/moderation/{report}/dismiss', [ModerationController::class, 'dismiss'])->name('admin.moderation.dismiss');
//     Route::post('/moderation/{report}/take-down', [ModerationController::class, 'takeDown'])->name('admin.moderation.takeDown');

   
// });


        
  


require __DIR__.'/auth.php';
