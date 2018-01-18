
@extends('layouts.master')

@section('content')
    <h2 class="text-center color-black">Блог</h2>
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                <div class="post">
                    <div class="post-title">
                        <a href="" class="color-black">Ad  sadasdasd</a>
                    </div>
                    <div class="post-image">
                        <img src="{{ asset('img/posts/1_2.jpg') }}" alt="" class="img-responsive">
                    </div>
                    <div class="post-short-content">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, voluptates!
                    </div>
                    <div class="post-data">
                        <div class="create-data">
                            <i class="fa fa-calendar" aria-hidden="true"></i> Jan 18, 2017
                        </div>
                        <div class="author">
                            <i class="fa fa-user-o" aria-hidden="true"></i> by David
                        </div>
                        <div class="comments">
                            <i class="fa fa-comment-o" aria-hidden="true"></i> 2
                        </div>
                    </div>
                    <div class="for-button">
                        <a href="" class="my-btn btn-white">Прочесть</a>
                    </div>
                </div>
                <div class="post">
                    <div class="post-title">
                        <a href="" class="color-black">Ad  sadasdasd</a>
                    </div>
                    <div class="post-image">
                        <img src="{{ asset('img/posts/3.jpg') }}" alt="" class="img-responsive">
                    </div>
                    <div class="post-short-content">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, voluptates!
                    </div>
                    <div class="post-data">
                        <div class="create-data">
                            <i class="fa fa-calendar" aria-hidden="true"></i> Jan 18, 2017
                        </div>
                        <div class="author">
                            <i class="fa fa-user-o" aria-hidden="true"></i> by David
                        </div>
                        <div class="comments">
                            <i class="fa fa-comment-o" aria-hidden="true"></i> 2
                        </div>
                    </div>
                    <div class="for-button">
                        <a href="" class="my-btn btn-white">Прочесть</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection