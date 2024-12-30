<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Product Details</title>

      <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
     <!-- Font-awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    </head>
    <body>
    <div class="row">
    <div class="col-md-10">
    </div>
    <div class="col-md-1">
    <a href="/" class="btn btn-danger">Add to cart</a>
    </div>
    </div>
        <div class="container" style="margin-top: 50px;">

            <h3 class="text-center text-success"><b>Product Details</b> </h3>
        
            <a href="/create" class="btn btn-outline-success">Add New Product</a>
          

            <table class="table table-striped table-bordered" style="margin-top: 10px;" >
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Cover Image</th>
                    <th>Update</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>


                    @foreach ($posts as $post)
                 <tr>
                       <th scope="row">{{ $post->id }}</th>
                       <td>{{ $post->name }}</td>
                       <td>{{ $post->price }}</td>
                       <td><img src="cover/{{ $post->cover }}" class="img-responsive" style="max-height:100px; max-width:100px" alt="" srcset=""></td>
                       <td><a href="/edit/{{ $post->id }}" class="btn btn-outline-primary">Update</a></td>
                       <td>
                           <form action="/delete/{{ $post->id }}" method="post">
                            <button class="btn btn-outline-danger" onclick="return confirm('Are you sure?');" type="submit">Delete</button>
                            @csrf
                            @method('delete')
                        </form>
                       </td>

                   </tr>
                   @endforeach

                </tbody>
              </table>
        </div>




    </body>
</html>
