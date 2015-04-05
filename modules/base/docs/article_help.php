<?php

  $input_1 =
  '
  PART::<br><br>

  H:: Header text ::H<br><br>

  Paragraph text<br><br>

  ::PART<br><br><br>

  PART::<br><br>

  H:: Header text ::H<br><br>

  Paragraph text and I:: italic ::I text<br><br>

  ::PART<br><br>

  PART::<br><br>

  H:: Some code ::H<br><br>

  CODE::<br><br>

  public class Dog{<br>
   String breed;<br>
   int age;<br>
   String color;<br><br>

   void barking(){<br>
   }<br><br>

   void hungry(){<br>
   }<br><br>

   void sleeping(){<br>
   }<br>
 }<br><br>

  ::CODE<br><br>

  ::PART

  ';

?>
<div class="text center squeezed">
	<h2>Input</h2>
	<code>
    <?php echo syntaxify($input_1); ?>
	</code>
</div>
<div class="text center squeezed">
	<?php echo textify($input_1); ?>
</div>
