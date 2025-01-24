<div class="pcr-app " data-theme="nano" aria-label="color picker dialog" role="window" style="left: 0px; top: 8px;">
    <div class="pcr-selection">
        <div class="pcr-color-preview">
            <button type="button" class="pcr-last-color" aria-label="use previous color"
                style="--pcr-color: rgba(132, 90, 223, 1);"></button>
            <div class="pcr-current-color" style="--pcr-color: rgba(132, 90, 223, 1);"></div>
        </div>

        <div class="pcr-color-palette">
            <div class="pcr-picker"
                style="left: calc(59.6413% - 9px); top: calc(12.549% - 9px); background: rgb(132, 90, 223);"></div>
            <div class="pcr-palette" tabindex="0" aria-label="color selection area" role="listbox"
                style="background: linear-gradient(to top, rgb(0, 0, 0), transparent), linear-gradient(to left, rgb(81, 0, 255), rgb(255, 255, 255));">
            </div>
        </div>

        <div class="pcr-color-chooser">
            <div class="pcr-picker" style="left: calc(71.9298% - 9px); background-color: rgb(81, 0, 255);"></div>
            <div class="pcr-hue pcr-slider" tabindex="0" aria-label="hue selection slider" role="slider"></div>
        </div>

        <div class="pcr-color-opacity" style="display:none" hidden="">
            <div class="pcr-picker"></div>
            <div class="pcr-opacity pcr-slider" tabindex="0" aria-label="selection slider" role="slider"></div>
        </div>
    </div>

    <div class="pcr-swatches "></div>

    <div class="pcr-interaction">
        <input class="pcr-result" type="text" spellcheck="false" aria-label="color input field">

        <input class="pcr-type" data-type="HEXA" value="HEXA" type="button" style="display:none" hidden="">
        <input class="pcr-type active" data-type="RGBA" value="RGBA" type="button">
        <input class="pcr-type" data-type="HSLA" value="HSLA" type="button" style="display:none" hidden="">
        <input class="pcr-type" data-type="HSVA" value="HSVA" type="button" style="display:none" hidden="">
        <input class="pcr-type" data-type="CMYK" value="CMYK" type="button" style="display:none" hidden="">

        <input class="pcr-save" value="Save" type="button" style="display:none" hidden=""
            aria-label="save and close">
        <input class="pcr-cancel" value="Cancel" type="button" style="display:none" hidden=""
            aria-label="cancel and close">
        <input class="pcr-clear" value="Clear" type="button" style="display:none" hidden=""
            aria-label="clear and close">
    </div>
</div>