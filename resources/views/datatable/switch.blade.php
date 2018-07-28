<?php
    if ($status == '1') {
        $status_check = "checked";
    } else {
        $status_check = "";
    }
?>
<div class="switch-button switch-button-xs">
    <input name="swt{{$id}}" rel="{{$id}}" formaction="{{$module}}" id="swt{{$id}}" {{$status_check}} type="checkbox" />
    <span class="change_status">
			<label for="swt{{$id}}"></label>
    </span>
</div>