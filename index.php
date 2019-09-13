<?php
/**
 * MDr 是一套基于 MDUI 开发的 Typecho 模板
 * 
 * @package MDr
 * @author FlyingSky
 * @version 1.0.1
 * @link https://fsky7.com/
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<div id="main">
<?php if ($this->_currentPage == 1 && !empty($this->options->ShowWhisper) && in_array('index', $this->options->ShowWhisper)): ?>
<article class="post whisper">
<div class="post-content">
<?php Whisper(); ?>
<?php if ($this->user->pass('editor', true) && (!FindContents('page-whisper.php') || isset(FindContents('page-whisper.php')[1]))): ?>
<p class="notice"><b>仅管理员可见: </b><br><?php echo FindContents('page-whisper.php') ? '发现多个"轻语"模板页面，已自动选取内容最多的页面作为展示，请删除多余模板页面。' : '未找到"轻语"模板页面，请检查是否创建模板页面。' ?></p>
<?php endif; ?>
</div>
</article>
<?php endif; ?>
<?php while($this->next()): ?>
<div class="mdui-card<?php if ($this->options->PjaxOption && $this->hidden): ?> protected<?php endif; ?>" style="margin-top: 20px;">
    <?php if ($this->options->PjaxOption && !$this->hidden and postThumb($this)): ?>
    <div class="mdui-card-media">
        <a href="<?php $this->permalink() ?>">
        <?php echo postThumb($this); ?>
        </a>
    </div>
    <?php endif; ?>
    <div class="mdui-card-primary" style="padding-bottom:8px;">
        <div class="mdui-card-primary-title"><?php $this->title() ?></div>
        <div class="mdui-card-primary-subtitle">
              <?php $this->date(); ?>
            | <?php $this->category(',', false); ?>
            | <?php $this->commentsNum('暂无评论', '%d 条评论'); ?>
            | <?php Postviews($this); ?>
            <?php if ($this->options->WordCount): ?>
            | <?php WordCount($this->cid); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="mdui-card-content" style="padding: 0px 16px;">
        <?php if ($this->options->PjaxOption && $this->hidden): ?>
        <form method="post" style="margin: 14px 0px;">
            <div class="mdui-row">
                <div class="mdui-col-xs-12 mdui-col-md-6">
                    <div class="mdui-textfield" style="padding-bottom: 32px;">
                        <label class="mdui-textfield-label">请输入密码访问</label>
                        <input class="mdui-textfield-input" type="password" class="text" name="protectPassword"/>
                    </div>
                </div>
                <div class="mdui-col-xs-12 mdui-col-md-6" style="padding-top:40px">
                    <input type="submit" class="mdui-btn mdui-ripple" value="提交" />
                </div>
            </div>
        </form>
        <?php else: ?>
        <p><?php $this->excerpt(200, ''); ?></p>
        <?php endif; ?>
    </div>
    <div class="mdui-card-actions" align="center">
        <a href="<?php $this->permalink() ?>" class="mdui-btn mdui-ripple" style="width:100%">阅读全文</a>
    </div>
</div>
<?php endwhile; ?>
<?php $this->pageNav('上一页', $this->options->AjaxLoad ? '查看更多' : '下一页', 0, '..', $this->options->AjaxLoad ? array('wrapClass' => 'page-navigator ajaxload') : ''); ?>
</div>
<?php $this->need('footer.php'); ?>