'use strict';
{
  
  console.log('log!!!1');
  const form_element      = document.querySelector('form[id="form-element"]');
  const input_element     = document.querySelector('input[name="protain-amount"]');
  const submit_element    = document.querySelector('button[id="submit-button"]');
  const div_element       = document.querySelector('div[id="form-div"]');

  // console.log(form_element);
  // console.log(div_element);
  
  div_element.addEventListener( "click", div_event => {
    console.log('type          :' + div_event.type);
    console.log('divclick');

    submit_element.onclick = (button_event) => {
      console.log(input_element.value);
      // もし入力が半角数字でないかつから文字（""）でもない場合
      if ( !input_element.value.trim().match(/^[0-9]{1,}$/) && input_element.value.trim() != "" ) {
        alert('半角数字で入力してください');
        // button_event.preventDefault();
      }
      else {
        console.log('submit!');
        document.protaininput.submit();
      }
    }

  } ) ;  


}

