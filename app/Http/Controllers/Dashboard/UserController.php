<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct() {
    //     abort_if(Gate::denies('addTeamMember'), Response::HTTP_FORBIDDEN);
    // }

    public function index(Request $request)
    {

        if (isset($request->search)) {
            $user = User::search('name', $request->search)->search('email', $request->search)->paginate(20);

            $user->appends(['search' => $request->search]);
        } else {
            $user = User::paginate(20);
        }

        return view('dashboard.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $team = Team::where('personal_team', 0)->get();
        $role = $this->roles();

        $data = [
            'team' => $team,
            'role' => $role
        ];

        return view('dashboard.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $user = new User();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        $user->current_team_id = $request->input('team');

        if ($request->has('photo')) {
            $user->updateProfilePhoto($request->file('photo'));
        }

        $user->save();

        DB::table('team_user')->insert([
            'team_id' => $request->input('team'),
            'user_id' => $user->id,
            'role' => $request->input('role')
        ]);

        return redirect()->route('dashboard.user.index')->with('flash.banner', 'Successfully created a new user!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($email)
    {
        $user = User::where('email', $email)->firstOrFail();
        $email = md5($user->email);
        return $email;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->deleteProfilePhoto();
        $user->delete();

        return redirect()->back()->with('flash.banner', 'Successfully deleted an user!');
    }

    public function roles()
    {
        return collect(Jetstream::$roles)->transform(function ($role) {
            return with($role->jsonSerialize(), function ($data) {
                return (new Role(
                    $data['key'],
                    $data['name'],
                    $data['permissions']
                ))->description($data['description']);
            });
        })->values()->all();
    }
}
