<?php
return [
    [
        "group"    => "basics",
        "icon"  => "fa fa-user",
        "title"  => "基础配置",
        "list"  => [
            [
                "type"      => "input",
                "title"     => "商城标题",
                "param"     => [
                    "name"      => "title",
                    "value"     => "",
                ],
                "explain"   => "",
                "require"   => "",
            ],
            [
                "type"      => "number",
                "title"     => "转发赠送人数上限",
                "param"     => [
                    "name"      => "top",
                    "value"     => "0",
                ],
                "explain"   => "0为不限制",
                "require"   => "",
            ],
            [
                "type"      => "number",
                "title"     => "分享每人赠送的积分数",
                "param"     => [
                    "name"      => "num",
                    "value"     => "0",
                ],
                "explain"   => "",
                "require"   => "",
            ],
            [
                "type"      => "file",
                "title"     => "头部广告图片",
                "param"     => [
                    "name"      => "top_ad_image",
                    "value"     => "0",
                ],
                "explain"   => "尺寸640*322",
                "require"   => "",
            ],
            [
                "type"      => "input",
                "title"     => "头部广告链接限",
                "param"     => [
                    "name"      => "top_ad_href",
                    "value"     => "0",
                ],
                "explain"   => "http://或https://开头",
                "require"   => "",
            ],
            [
                "type"      => "textarea",
                "title"     => "关于",
                "param"     => [
                    "name"      => "about",
                    "value"     => "一个好用的积分商城",
                ],
                "explain"   => "",
                "require"   => "",
            ],
        ],
    ],
    [
        "group"    => "follow",
        "icon"  => "fa fa-user",
        "title"  => "关注配置",
        "list"  => [
            [
                "type"      => "radio",
                "title"     => "强制关注",
                "param"     => [
                    "lines"     => [['text'=>"开启","value"=>"1"],["text"=>"关闭","value"=>"0"]],
                    "name"      => "type",
                    "value"     => "1",
                ],
                "explain"   => "(此功能仅限于认证服务号)选择是，打开页面后弹出二维码，提示用户关注。",
                "require"   => "",
            ],
            [
                "type"      => "file",
                "title"     => "关注二维码",
                "param"     => [
                    "name"      => "image",
                    "value"     => "0",
                ],
                "explain"   => "尺寸300*300",
                "require"   => "",
            ],
            [
                "type"      => "input",
                "title"     => "二维码话术",
                "param"     => [
                    "name"      => "txt",
                    "value"     => "您还未关注本公众号，长按二维码关注后，发送积分商城即可参与活动",
                ],
                "explain"   => "",
                "require"   => "",
            ],
        ],
    ],
    [
        "group"    => "share",
        "icon"  => "fa fa-home",
        "title"  => "分享配置",
        "list"  => [
            [
                "type"      => "input",
                "title"     => "分享标题",
                "param"     => [
                    "name"      => "title",
                    "value"     => "",
                ],
                "explain"   => "分享到朋友圈的自定义标题。",
                "require"   => "",
            ],
            [
                "type"      => "textarea",
                "title"     => "分享简介",
                "param"     => [
                    "name"      => "desc",
                    "value"     => "",
                ],
                "explain"   => "分享到朋友圈的自定义描述。",
                "require"   => "",
            ],
            [
                "type"      => "file",
                "title"     => "分享图标",
                "param"     => [
                    "name"      => "image",
                    "value"     => "",
                ],
                "explain"   => "分享到朋友圈的自定义图片。",
                "require"   => "",
            ],
            
        ],
    ],
];