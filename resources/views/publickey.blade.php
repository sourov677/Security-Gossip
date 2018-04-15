<style type="text/css">
    html,body{
        background-image: url('data-security.jpg');
        background-position: center;
        background-repeat: no-repeat;
    }
    #ppp{
        margin-top: 17%;
    }
</style>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create your encrypted text here</div>

                <div class="panel-body">
                    @if($errors->has('text'))
                        <div class="alert alert-danger">
                            <p>Error in text.</p>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                    <form action=" " method="POST">
                        {{csrf_field()}}
                        <label for="text">Enter you text: </label>
                        <textarea class="form-control text_area" name="text" id="text">

                        </textarea>



                        <select class="form-control" name="type" id="type">
                            <option value=" ">Select Encryption</option>
                            <option value="Encrypt">Encryption</option>
                            <option value="Decrypt">Decryption</option>

                        </select>
                        <button class="btn btn-success">Submit</button>

                    </form>



                </div>
            </div>
        </div>
    </div>

    <script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  document.execCommand("Copy");

}
</script>
    <div class="row" style="margin-top: 100px; text-align: center;">
         @if(session('enct'))
                        <div class="output" style="margin-bottom: 100px;">
                            <h2 id="cipher">Encrypted text</h2>
                            <hr>
                           <span style="color: blue;"> {{session('enct')}} </span><br>

                           <input type="text" value=" {{session('enct')}}" id="myInput"  hidden=""><br>
                            <button onclick="myFunction()" class="btn btn-primary">Copy text</button>
                            <a href="mailto:info@example,com" class="btn btn-success">Mail</a>
                        </div>

                    @endif
    </div>
</div>


</div>
@endsection
