<h2>Response</h2>
<pre>
<?php
    var_dump($response);
?>
</pre>

<h3>Tested values</h3>
<p>
<?php 
echo 'Expected parameter <mark>' . $expectedParamKey . '</mark>';

if ($expectedParamValue)
{
    echo ' = <mark>' . $expectedParamValue . '</mark>';
}

echo '.'
?>
</p>

<p> Found? 
  <?php 
  if ($testPassed)
  {
      echo yii\helpers\Html::tag('p', 'ok', ['class' => 'text-success']);
  }
  else
  {
      echo yii\helpers\Html::tag('p', 'no', ['class' => 'text-danger']);
  }
  ?>  
   
</p>
