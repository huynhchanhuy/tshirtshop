{* main *}
{config_load file="site.conf"}
{load_presentation_object filename="main"  assign="obj"}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>
            {#site_title#}
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link type="text/css" rel="stylesheet" href="styles/tshirtshop.css" />
    </head>
</html>
<body>
    <div id="doc" class="yui-t2">
        <div id="bd">
            <div id="yui-main">
                <div class="yui-b">
                    <div id="header" class="yui-g">
{*                        <a href="index.php">*}
{*                            <img src="images/tshirtshop.png" alt="tshirtshop logo" />*}
                        <a href="{$obj->mSiteUrl}">
                            <img src="{$obj->mSiteUrl}images/tshirtshop.png"
                                 alt="tshirtshop logo"/>
                        </a>
                    </div>
                    <div id="contents" class="yui-g">
                        {* mContentsCell contains "tpl filename" link to department *}
                        {* This is the right section of webpage including department detail, category detail and product list *}
                        {include file=$obj->mContentsCell}
                    </div>
                </div>
            </div>
            <div class="yui-b">
                {* List of department*}
                {include file=$obj->mDepartmentsCell}
                {* List of categories following the department *}
                {include file=$obj->mCategoriesCell}
            </div>
        </div>
    </div>
</body>