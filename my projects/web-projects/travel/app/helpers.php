<?php
function formResponse($status,$content='')
{
    return ['content'=>$content, 'status'=>$status];
}