<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;

class AuthService
{
    private UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function addUser(array $data): User
    {
        return $this->userRepository->addUser($data);
    }

    public function findUserByEmail($email): Model|null
    {
        return $this->userRepository->findByEmail($email);
    }

}
