'use strict';
{
  const form_element      = document.querySelector('form[id="form-element"]');
  const input_element     = document.querySelector('input[name="protain-amount"]');
  const submit_element    = document.querySelector('button[id="submit-button"]');
  const div_element       = document.querySelector('div[id="form-div"]');
  
  div_element.addEventListener( "click", div_event => {

    submit_element.onclick = isHalfWidthDigit;
    input_element.addEventListener("keydown", isPutEnterKey);

  } ) ;  

  // 半角数字判定
  const isHalfWidthDigit = function (button_event) {
    // もし入力が半角数字でないかつ空文字（""）でもない場合
    if (!input_element.value.trim().match(/^[0-9]{1,}$/) && input_element.value.trim() != "") {
      alert('半角数字で入力してください');
      button_event.preventDefault();
    }
    else {
      document.protaininput.submit();
    }
  }

  // enterキー押下判定trueならclickイベント発火
  const isPutEnterKey = function (event) {
      if (event.keyCode === 13) {
        submit_element.click();
        event.preventDefault();
      }
  }

}

