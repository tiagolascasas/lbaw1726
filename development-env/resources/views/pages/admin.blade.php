@extends('layouts.app')

@section('title', 'Administrator')

@section('content')

 <!-- Admin dashboard -->
        <div class="container-fluid bg-white">
            <!-- Title-->
            <div class="bg-white mb-0 mt-4 panel">
                <h5>
                    <i class="fa fa-gavel"></i> Manage users </h5>
            </div>
            <form class="ml-4 mr-4">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Select an user</label>
                        <input class="form-control" type="text" list="userList" placeholder="username">
                        <datalist class="form-control" id="userList" hidden>
                            <option value="tiagolascasas">
                            <option value="rubentorres">
                            <option value="nelsoncosta">
                            <option value="danielazevedo">
                            <option value="user1">
                            <option value="user2">
                        </datalist>
                    </div>
                </div>
                <a class="btn btn-primary col-md-12 mb-4" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Take an action
                </a>
                <div class="collapse" id="collapseExample">
                    <button type="submit" class="btn col-md-12 mb-2 btn-outline-secondary">Suspend user indefinitely</button>
                    <button type="submit" class="btn col-md-12 mb-2 btn-outline-secondary">Reactivate suspended user</button>
                    <button type="submit" class="btn col-md-12 mb-2 btn-outline-secondary">Ban user permanently</button>
                    <button type="submit" class="btn col-md-12 mb-2 btn-outline-secondary">Promote user to moderator</button>
                    <button type="submit" class="btn col-md-12 mb-2 btn-outline-secondary">Revoke moderator privileges</button>
                </div>
            </form>
            <div class="bg-white mb-0 mt-4 panel">
                <h5>
                    <i class="fa fa-gavel"></i> Account deletion requests </h5>
            </div>

            <hr id="hr_space" class="mt-2">

            <div class="my-3">

                <a href="#" class="list-group-item list-group-item-action text-muted">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 align-self-center text-left p-2 text-dark lead">
                                tiagolascasas
                            </div>
                            <div class="btn-group">
                                <span class="btn btn-sm btn-outline-secondary align-self-center p-2 m-2" onclick="profile_func()">Profile</span>
                            </div>
                            <div class="btn-group">
                                <span class="btn btn-sm btn-outline-secondary align-self-center p-2 m-2">Delete</span>
                            </div>
                            <div class="btn-group">
                                <span class="btn btn-sm btn-outline-secondary align-self-center p-2 m-2">Ignore</span>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="#" class="list-group-item list-group-item-action text-muted">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 align-self-center text-left p-2 text-dark lead">
                                nelsoncosta
                            </div>
                            <div class="btn-group">
                                <span class="btn btn-sm btn-outline-secondary align-self-center p-2 m-2" onclick="profile_func()">Profile</span>
                            </div>
                            <div class="btn-group">
                                <span class="btn btn-sm btn-outline-secondary align-self-center p-2 m-2">Delete</span>
                            </div>
                            <div class="btn-group">
                                <span class="btn btn-success btn-sm btn-outline-secondary align-self-center p-2 m-2">Ignore</span>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>
@endsection