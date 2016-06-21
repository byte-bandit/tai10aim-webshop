<?PHP
require_once('address_preset_func.php');
?>
<input name='name' type='text'  value='<?echo($row->prename);?>' > Ihr Name</input> <br/>
<input name='prename' type='text'  value='<?echo($row->surname);?>' > Ihr Vorname</input><br/><br/>
<input name='street' type='text' placeholder='Straﬂe' value='<?echo($row_address1->street);?>' required> Ihre Straﬂe</input>
<input name='number' type='text' placeholder='Hausnummer' value='<?echo($row_address1->number);?>' required> Ihre Hausnummer</input><br/>
<input name='zipcode' type='text' placeholder='Postleitzahl' value='<?echo($row_address1->zipcode);?>' required> Ihre Postleitzahl</input>
<input name='location' type='text' placeholder='Ort' value='<?echo($row_address1->location);?>' required> Ihr Wohnort</input><br/>