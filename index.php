<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>E-mail distrubution system</title>
  </head>
  <body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


<div class="container">
  <h1 class="mx-auto text-primary text-center">
    Email Distibution system
  </h1>
  <div class="form-group">
    <label for="exampleInpu">Email address</label>
    <input type="email" class="form-control" id="remail" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="rname">Recipient Name</label>
    <input type="text" class="form-control" id="rname" placeholder="Recipient Name">
  </div>
  <button type="submit" class="btn btn-primary"onclick="addRecipient()">Submit</button>

<div id="result">
  
</div>

<div id="recipientlist">
  
</div>


</div>




<script type="text/javascript">
  function addRecipient(){
    let remail=$("#remail").val();
    let rname=$("#rname").val();
    $.post(
      "http://192.168.33.10/email-b/recipient/add",
      {
        "name":rname,
        "email":remail,
      },
      function(data){
        if(data.code>300){
          $("#result").html(
            `<div class="alert alert-danger" role="alert">
              Recipient add failed, please try again!
            </div>`
            );
        }else{
          $("#result").html(
          `<div class="alert alert-success" role="alert">
            Recipient add successfully!
          </div>`
            );
          getAllRecipient();
        }
      },
      'json'
    );
  }



  function getAllRecipient(){
    $.get("http://192.168.33.10/email-b/recipient",
      function(data){
        let str = `<div class="row mt-5">`;
        $.each(JSON.parse(data),function(i,value){
          console.log(value);
          let item = `<div class="col-4 py-4 border border-primary">Name:` + value.name +`</div>` + `<div class="col-6 py-4 border border-primary">`+`Email:`+ value.Email+`</div>`+`<div class="col-2 py-4 border border-primary text-center"><button class="btn btn-primary" onclick="send(`+ value.id +`)">send</button></div>`;
          str = str +item;
        });
        str=str+"</div>";
        $("#recipientlist").html(
          str
          );
      })
  }


  $(document).ready(
  function(){
    getAllRecipient();

  }
  );

  function send(id){
    $.get(
      "http://192.168.33.10/email-b/email/send/"+id,
      function(data){

      }
      );
  }
</script>


  </body>
</html>