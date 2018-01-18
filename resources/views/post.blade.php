
@extends('layouts.master')

@section('content')
    <ul class="breadcrumb hidden-xs">
        <li><a href="#">Home</a></li>
        <li><a href="#">Products</a></li>
        <li class="active">Accessories</li>
    </ul>
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                <div class="post">
                    <div class="post-title">asdasdasdasdasd asd</div>
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
                    <div class="post-image">
                        <img src="{{ asset('img/posts/3.jpg') }}" alt="" class="img-responsive">
                    </div>
                    <div class="post-content">
                        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab amet assumenda at consectetur
                            esse, explicabo facere fugiat harum molestias neque officiis optio placeat quo quos rerum
                            temporibus voluptate voluptates? Repellendus?
                        </div>
                        <div>In molestiae quod recusandae vel! Ab ad cumque deserunt, dicta dolore, ipsa laborum libero
                            nam necessitatibus obcaecati, odit perspiciatis possimus quidem tempora voluptate. Ad enim
                            magnam quo ullam velit voluptates!
                        </div>
                        <div>At eaque eligendi esse fugiat laudantium, necessitatibus nisi placeat saepe sed sunt ullam
                            voluptas. Aperiam cupiditate, deleniti dignissimos earum error esse exercitationem impedit,
                            magnam modi molestias quasi sequi sint suscipit!
                        </div>
                        <div>Autem eveniet expedita iure libero quos temporibus! Distinctio dolorem ipsum quis. A
                            aperiam asperiores, beatae consectetur deserunt ducimus ipsa laudantium molestiae mollitia
                            nisi non perferendis quaerat, quasi sed, ullam velit.
                        </div>
                    </div>
                </div>
                <hr>

                @include('templates.comments')

            </div>
        </div>
    </div>
@endsection