<?php

/**
 * @author Ivan Abashin <juiceworkmail@gmail.com>
 */


namespace Juliaaan1\Blog\Auth;


use Juliaaan1\Blog\User;
use Tuupola\Middleware\HttpBasicAuthentication\AuthenticatorInterface;

class Database implements AuthenticatorInterface {
    protected User\Repository $repository;

    function __construct(User\Repository $repository) {
        $this->repository = $repository;
    }

    function __invoke(array $arguments): bool {
        $login = $arguments['user'];
        $password = $arguments['password'];

        if (!$login || !$password) {
            return false;
        }

        $user = $this->repository->findByLogin($login);

        if (!$user) {
            return false;
        }

        return password_verify($password, $user->hash);
    }
}
