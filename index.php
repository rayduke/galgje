<?php
session_start();
       if(isset($_POST['opnieuw'])){
          session_destroy();
          header("Refresh:0");
       }

include "functions.php";
?>
<!DOCTYPE HTML>

<html>
    
    
<head>  
    <link rel="stylesheet" media="all" href="style.css"/>
    <meta charset="utf-8" />  
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <script src="script.js"></script>
    <link rel="stylesheet" media="all" href="style.css"/>
    
</head>  

<body>
 <header>
     <h1>Galgje!</h1>
     <h2>Raad het woord</h2>

 </header>    
  <main>

    
    <?php
    if (empty($hidden)){ $hidden = " ";}
    if (!isset($einde)){ $einde = false;}  
    
    if(empty($_POST['submit'])){

        $woorden = ['apen', 'koe', 'peer', 'netbeans', 'galgje', 'boom', 'huis', 'javascript', 'sinaassappel'];
        $rand = rand(0, count($woorden)-1);
        $woord = $woorden[$rand];
        $_SESSION['woord'] = $woord;
        $teller = 7;
        
        
        for ($i=0 ;$i < strlen($woord); $i++){
            $hidden .="-";
            
  
        }
        
    }elseif($_POST['submit']) {
      $letter =  $_POST['letter'];
      $woord = $_SESSION['woord'];
      $hiddenword = $_POST['hidden'];
      $gebruikt = $_POST['gebruikt'];
      $teller = $_POST['teller'];
      $gebruikt .=$teller ;
      $hidden = "";
      $juist = false;
      $einde = false;
      
      for($x=0 ;$x<strlen($woord) ;$x++){
        if (substr($woord,$x,1)==$letter){
            $hidden .= $letter;
            $juist=true;
        }else{
            $hidden .= substr($hiddenword,$x,1);
        }
      }
      
      if(!$juist && $teller > 0 ){
          $teller--;
      }
    }
      

     
    ?>
      <div id="spel">
         <?php
         
          
          switch ($teller){
              
              case 6: 
                  echo showimage('teller6.jpg');
                  break;
             
              case 5: 
                  echo showimage('teller5.jpg');
                  break;
              
              case 4: 
                  echo showimage('teller4.jpg');
                  break;
              
              case 3: 
                  echo showimage('teller3.jpg');
                  break;
              
              case 2: 
                  echo showimage('teller2.jpg');
                  break;
              
              case 1: 
                  echo showimage('teller1.jpg');
                  break;
              
              case 0: 
                  echo showimage('teller0.jpg');
                  echo "Game-Over<br>";
                  echo "<br>Het woord was: " . $woord;
          
                  $einde = true;
                  break;
              
              default:
                  echo showimage('teller7.jpg');
                  break;
                  
              
          }
              if($woord == $hidden){
                 echo "<p>Gefeliciteerd je hebt het woord geraden.<p><br>";
                 echo "<p>Het woord was: </p>" . $woord;
          
              }elseif(!$einde){
                 if($einde = true){
                    echo $hidden . "<br>";
                 }
              }
      

         ?>
          
         
      </div>
       
      <div id="spel"> 
        <form name=form1 action="" method="POST"> 
           <input type="text" name="letter" maxlength=1 >
           <input type="hidden" name="gebruikt" value="<?php echo $gebruikt; ?>">
           <input type="hidden" name="hidden" value="<?php echo $hidden; ?>">
           <input type="hidden" name="teller" value="<?php echo $teller; ?>">
           <input type=submit name="submit" id="check" value=check>
           <input type=submit name="opnieuw" value=opnieuw>
      </div>
  
      
     
    </form>
          
  </main> 
        <div id="img">
         <?php 
         if ($teller == 0){
             echo '<img id="img" src="img/face1.jpg" alt="face">';
             echo '<audio autoplay>';
             echo '<source src="audio/scream2.mp3" type="audio/mpeg">';
             echo '</audio>';
         }
         ?>
      </div>
</body>


</html>

