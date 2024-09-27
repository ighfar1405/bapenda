<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Repository\User\UserRepository;

class UserController extends Controller
{
    /**
     * User repository.
     *
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Lists.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $users = $this->userRepository->all();
        return view('users.index', [
            'users' => $users
        ]);
    }

    /**
     * Form create.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Create action.
     *
     * @param UserRequest $request
     * @return Response
     */
    public function store(UserRequest $request)
    {
        $user = $this->userRepository->create(
            $request->only(['nama', 'username', 'email', 'password', 'hak_akses'])
        );

        return redirect()->route('users.index')
                ->with('success', "{$user->nama} berhasil disimpan");
    }

    /**
     * Form edit.
     *
     * @param string $id
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Edit action.
     *
     * @param UserRequest $request
     * @param string $id
     * @return Response
     */
    public function update(UserRequest $request, $id)
    {
        $this->userRepository->update(
            $id,
            $request->only(['nama', 'username', 'email', 'password', 'hak_akses'])
        );

        return redirect()->route('users.index')
                ->with('success', 'User berhasil disimpan');
    }

    /**
     * Delete action.
     *
     * @param string $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->userRepository->delete($id);
        return redirect()->route('users.index')
                ->with('success', 'User berhasil dihapus');
    }
}
