<!DOCTYPE html>
<html>
  <head>
    <title>Plutchik's Emotion Tagger</title>
    <style>

    /* The emotion inputs container (left box)*/
    #emotions{
      background-color: #AAAAAA;
    }
    
    /* The text container (right box)*/
    #text{
      padding-left:20px;
      max-width: 300px;
      font-size: 22px;
      background-color: lightgrey;
    }
  
    /* An emotion container */
    .emotion {
      display: block;
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      font-size: 22px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    /* Hide the browser's default checkbox */
    .emotion input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #eee;
    }

    /* On mouse-over, add a grey background color */
    .emotion:hover input ~ .checkmark {
      background-color: #ccc;
    }


    /* When the anger checkbox is checked, add a color */
    .emotion #anger:checked ~ .checkmark {
      background-color: #FF0000;
    }

    /* When the fear checkbox is checked, add a color */
    .emotion #fear:checked ~ .checkmark {
      background-color: #00FF00;
    }

    /* When the sadness checkbox is checked, add a color */
    .emotion #sadness:checked ~ .checkmark {
      background-color: #0000FF;
    }


    /* When the disgust checkbox is checked, add a color */
    .emotion #disgust:checked ~ .checkmark {
      background-color: #FF00FF;
    }


    /* When the anticipation checkbox is checked, add a color */
    .emotion #anticipation:checked ~ .checkmark {
      background-color: #FFAA00;
    }

    /* When the trust checkbox is checked, add a color */
    .emotion #trust:checked ~ .checkmark {
      background-color: #AAFFAA;
    }

    /* When the joy checkbox is checked, add a color */
    .emotion #joy:checked ~ .checkmark {
      background-color: #FFFF00;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }

    /* Show the checkmark when checked */
    .emotion input:checked ~ .checkmark:after {
      display: block;
    }

    /* Style the checkmark/indicator */
    .emotion .checkmark:after {
      left: 7px;
      top: 7px;
      width: 5px;
      height: 5px;
      border: solid white;
      border-width: 3px 3px 3px 3px;
      border-radius: 10px;
    }

    /* Style the joy checkmark/indicator */
    .emotion #joy:checked ~ .checkmark:after {
      left: 7px;
      top: 7px;
      width: 5px;
      height: 5px;
      border: solid black;
      border-width: 3px 3px 3px 3px;
      border-radius: 10px;
    }
  
    </style>
  </head>
  <body>
    <center>
      <h1>Plutchik's Emotion Tagger</h1>
      <table>
        <tr>
          <th>Emotions</th>
          <th>Text</th>
        </tr> 
        <tr>
          <td id='emotions'>
            <label class="emotion">Anger
              <input id="anger" name="anger" type="checkbox">
              <span class="checkmark"></span>
            </label>
            <label class="emotion">Fear
              <input id="fear" name="fear" type="checkbox">
              <span class="checkmark"></span>
            </label>
            <label class="emotion">Sadness
              <input id="sadness" name="sadness" type="checkbox">
              <span class="checkmark"></span>
            </label>
            <label class="emotion">Disgust
              <input id="disgust" name="disgust" type="checkbox">
              <span class="checkmark"></span>
            </label>
            <label class="emotion">Anticipation
              <input id="anticipation" name="anticipation" type="checkbox">
              <span class="checkmark"></span>
            </label>
            <label class="emotion">Trust
              <input id="trust" name="trust" type="checkbox">
              <span class="checkmark"></span>
            </label>
            <label class="emotion">Joy
              <input id="joy" name="joy" type="checkbox">
              <span class="checkmark"></span>
            </label>
          </td>
          <td id='text'>
            <?php
            $string = "Emotion riddled sentence that will generate an amazing feelings dataset.";
            echo $string; 
            ?>
          </td>
        </tr>
      </table>
    </center>
  </body>
</html>
