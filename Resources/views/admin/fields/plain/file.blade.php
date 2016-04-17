<style>
    figure.jsThumbnailImageWrapper {
        position: relative;
        display: inline-block;
        background-color: #fff;
        border: 1px solid #eee;
        padding: 3px;
        border-radius: 3px;
    }
    figure.jsThumbnailImageWrapper img {
        max-width: 150px;
    }
</style>
<?php
$random = mt_rand();
?>
<script>
    window["openMediaWindow{{ $random }}"] = function (event) {
        window.open('{!! route('media.grid.select') !!}?callbackFunction=includeMedia{{ $random }}', '_blank', 'menubar=no,status=no,toolbar=no,scrollbars=yes,height=500,width=1000');
    };
    window["includeMedia{{ $random }}"] = function (mediaId, mediaUrl) {
        $("[name='{{ $settingName }}']").val(mediaUrl);
        $('.simple-wrap-{{ $random }} .jsThumbnailImageWrapper').html('<a href="' + mediaUrl + '" target="_blank"><img src="' + mediaUrl + '" alt=""/></a>');

    };
</script>
<div class="form-group simple-wrap-{{ $random }}">
    {!! Form::label($settingName, trans($moduleInfo['description'])) !!}
    <?php if (isset($dbSettings[$settingName])): ?>
    {!! Form::text($settingName, Input::old($settingName, $dbSettings[$settingName]->plainValue), ['class' => 'form-control', 'placeholder' => trans($moduleInfo['description']), 'readonly' => '']) !!}
    <?php else: ?>
    {!! Form::text($settingName, Input::old($settingName), ['class' => 'form-control', 'placeholder' => trans($moduleInfo['description'])]) !!}
    <?php endif; ?>
    <div class="clearfix"></div>
    <figure class="jsThumbnailImageWrapper">
        <?php if (isset($dbSettings[$settingName])): ?>
            <a href="{{ $dbSettings[$settingName]->plainValue }}" target="_blank"><img src="{{ $dbSettings[$settingName]->plainValue }}" alt=""/></a>
        <?php endif; ?>
    </figure>
    <div class="clearfix"></div>
    <a class="btn btn-primary btn-browse" onclick="openMediaWindow{{ $random }}(event);"><i class="fa fa-upload"></i>
        {{ trans('media::media.Browse') }}
    </a>

</div>
