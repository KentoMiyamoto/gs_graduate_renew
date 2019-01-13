@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
    @include('common.errors')
    <form action="{{ url('books/update') }}" method="POST">

        <!-- item_name -->
        <div class="form-group">
           <label for="item_name">user_id</label>
           <lavel type="text" id="item_name" name="item_name" class="form-control" value="">
        <?php echo $opponent->user_id ?>
        
        </div>
        <!--/ item_name -->
        
        <!-- item_number -->
        <div class="form-group">
           <label for="item_number">friend_id</label>
        <lavel type="text" id="item_number" name="item_number" class="form-control" value="{{$opponent->friend_id }}">
        <?php echo $opponent->friend_id ?>
        </div>
        <!--/ item_number -->

        <!-- item_amount -->
        <div class="form-group">
           <label for="item_amount">location</label>
        <lavel type="text" id="item_amount" name="item_amount" class="form-control" value="{{ $opponent->location }}">
         <?php echo $opponent->location ?>
        </div>
        <!--/ item_amount -->
        
        <!-- published -->
        <div class="form-group">
           <label for="published">entry_time</label>
            <lavel type="datetime" id="published" name="published" class="form-control" value="{{ $opponent->created_at }}"/>
         <?php echo $opponent->created_at ?>
        </div>
        <!--/ published -->
        
        
                         
        
        <!-- Saveボタン/Backボタン -->
        <div class="well well-sm">
            <button type="submit" class="btn btn-primary">OK</button>
            
                                <form action="{{ url('/') }}" method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger">
                                            <i class="glyphicon glyphicon-trash"></i> NG
                                        </button>
                                    </form>
    
            
            <a class="btn btn-link pull-right" href="{{ url('/') }}">
                <i class="glyphicon glyphicon-backward"></i>  Back
            </a>
        
    </div>    
        
        <!--/ Saveボタン/Backボタン -->
         
         <!-- id値を送信 -->
         <input type="hidden" name="id" value="" />
         <!--/ id値を送信 -->
         
         <!-- CSRF -->
         {{ csrf_field() }}
         <!--/ CSRF -->
         
    </form>
    
        
    </div>
</div>
@endsection