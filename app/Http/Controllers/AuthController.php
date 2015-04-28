<?php namespace Pop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Pop\Transformers\UserTransformer;

class AuthController extends ApiController {

    /**
     * The Guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * The registrar implementation.
     *
     * @var \Illuminate\Contracts\Auth\Registrar
     */
    protected $registrar;

    /**
     * Model transformer implementation.
     *
     * @var \Pop\Transformers\UserTransformer
     */
    protected $transformer;

    public function __construct(Guard $auth, Registrar $registrar, UserTransformer $transformer)
    {
        $this->auth = $auth;
        $this->registrar = $registrar;
        $this->transformer = $transformer;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->registrar->validator($request->all());

        if ($validator->fails())
        {
            return $this->respondNotValid($validator->getMessageBag()->getMessages());
        }

        $user = $this->registrar->create($request->all());

        return $this->transformer->transform($user);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if ($this->auth->attempt($credentials, $request->has('remember')))
        {
            return $this->respondLoginSuccessful();
        }

        return $this->respondUnauthorized("Invalid email or password");
    }

    protected function respondLoginSuccessful() {
        return $this->respondWithSuccess("Logged In Successfully", $this->transformer->transform($this->auth->user()));
    }
}