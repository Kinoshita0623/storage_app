@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="files" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card">
                    <div class="card-header">
                        ファイルのアップロード
                        
                    </div>
    
                    <div class="card-body">
                        <input type="file" name="file" class="form-control-file">
                        <button type="submit" class="btn btn-primary" id="upload-button">アップロード</button>
                    </div>
                </div>
                
                
            </form>
            
            <div class="card">
                <div class="card-header">{{ $user->name }}のファイル一覧</div>

                <div class="card-body">
                    @foreach ($user->files as $file)
                        <div class="file_item">
                            <a href='storage/{{$file->path}}'>
                                {{$file->name}}
                            </a>
                            
                        <form method="POST" action="files/{{$file->id}}">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <input type="submit" value="削除">
                        </form>
                        </div>
                                
                    @endforeach
                    
                </div>
            </div>
        </div>
        
        
    </div>
</div>
    
@endsection