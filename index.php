<html>
<head>
<title>Bond Web Service Demo</title>
<style>
body {font-family:georgia;}
  .nba{
    border:1px solid #E77DC2;
    border-radius: 5px;
    padding: 5px;
    margin-bottom:5px;
    position:relative;
  }
 
  .pic{
    position:absolute;
    right:10px;
    top:10px;
  }

  .pic img{
    max-width:70px;
  }

</style>
<script src="https://code.jquery.com/jquery-latest.js" type="text/javascript"></script>

<script type="text/javascript">
function nbaTemplate(team){
   return `<div class="nba">
      <b>Rank: </b> ${team.Rank}<br />
      <b>Team: </b> ${team.Team}<br />
      <b>State: </b> ${team.State}<br />
      <b>Coach: </b> ${team.Coach}<br />
      <b>Mascot: </b> ${team.Mascot}<br />
      <div class="pic"><img src="thumbnails/${team.Image}" /></div>
    </div>`;
}
$(document).ready(function() {
    $('.category').click(function(e){
    e.preventDefault(); //stop default action of the link
        cat = $(this).attr("href");  //get category from URL
    var request = $.ajax({
      url: "api.php?cat=" + cat,
      method: "GET",
      dataType: "json"
    });
    request.done(function( data ) {
      console.log(data);
      $("#nbatitle").html(data.title);
      //clears the previous films
      $("#nbas").html("");
      //loops through films 
      $.each(data.teams,function(key,value){
      let str = nbaTemplate(value);
      $("<div></div>").html(str).appendTo("#nbas");

      });
      //Place the title of the web service on the page
      //$("#output").text(JSON.stringify(data));

      // let myData = JSON.stringify(data,null,4);
      // myData = "<pre>" + myData + "</pre>";
      // $("#output").html(myData);


    });
    request.fail(function(xhr, status, error) {
      //Ajax request failed.
      var errorMessage = xhr.status + ': ' + xhr.statusText
      alert('Error - ' + errorMessage);
    });
    });
});
</script>
</head>
    <body>
    <h1>National Basketball Association</h1>
        <a href="conference" class="category">NBA Conference</a><br />
        <a href="standing" class="category">NBA Teams</a>
        <h3 id="nbatitle">Title Will Go Here</h3>
        <div id="nbas">
            <p>NBA</p>
        </div>
        <div id="output">Results go here</div>
    </body>
</html>