<?php $this->comments()->to($comments); ?>
<?php function threadedComments($comments, $options)
{
    $commentClass = '';
    $commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';  //评论层数大于0为子级，否则是父级
?>
<div id="<?php $comments->theId(); ?>" class="comment mdl-color-text--grey-700 comment-body<?php
    if ($comments->_levels > 0) {
        echo ' comment-child';
        $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
    } else {
        echo ' comment-parent';
    }
    $comments->alt(' comment-odd', ' comment-even');
    echo $commentClass; ?>">

    <!-- Comment info -->
    <header class="comment header">

        <!-- Comment avatar -->
        <div id="comment__avatar">
            <?php $comments->gravatar(52); ?>
        </div>

        <!-- Comment author -->
        <div class="comment__author">
            <!--Commenter name -->
            <span class="visitor-name-span"><?php $comments->author(); ?>&nbsp;</span>
            <!--Comment date -->
            <span><?php $comments->date('Y-m-d, H:i'); ?></span>
			<!-- reply -->
			<?php
				$comments->reply();
			?>
        </div>
    </header>

    <!-- Comment content -->
    <div class="comment__text">
        <?php $comments->content(); ?>
    </div>

    <!-- Comment answers -->
    <div class="comment__answers">
    <?php if ($comments->children) { ?>
        <!--是否嵌套评论判断开始-->
        <div class="comment-children">
            <?php $comments->threadedComments($options); ?>
            <!--嵌套评论所有内容-->
        </div>
        <!--是否嵌套评论判断结束-->
    <?php } ?>
    </div>

</div>

<?php
} ?>

<div class="mdl-color-text--primary-contrast mdl-card__supporting-text comments">

    <?php if ($this->allow('comment')): ?>
        <?php $comments->listComments(); ?>
        <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>

    <div id="<?php $this->respondId(); ?>" class="respond">



        <!-- Input form start -->
        <form method="post" action="<?php $this->commentUrl() ?>">

            <!-- If user has login -->
            <?php if ($this->user->hasLogin()): ?>

            <!-- Display user name & logout -->
            <br />
            <p style="color:#8A8A8A;" class="visitor-name-span">Logged in as
                <a href="<?php $this->options->adminUrl(); ?>" style="font-weight:400"><?php $this->user->screenName(); ?></a>.
                <a href="<?php $this->options->logoutUrl(); ?>" title="Logout" style="font-weight:400">Logout &raquo;</a>
                <?php $comments->cancelReply(); ?>
            </p>

            <!-- If user didn't login -->
            <?php else: ?>

            <!-- Input name -->
            <div class="login-form-group">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input type="text" name="author" class="mdl-textfield__input login-input-info" />
                    <label for="author" class="mdl-textfield__label">
                                    <?php if ($this->options->langis == '0'): ?> Name*
                                    <?php elseif ($this->options->langis == '1'): ?> 昵称*
                                    <?php elseif ($this->options->langis == '2'): ?> 昵称*
                                    <?php endif; ?>
                                </label>
                </div>
            </div>

            <!-- Input email -->
            <div class="login-form-group">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input type="email" name="mail" class="mdl-textfield__input login-input-info" />
                    <label for="mail" class="mdl-textfield__label">
                                    <?php if ($this->options->langis == '0'): ?> Email*
                                    <?php elseif ($this->options->langis == '1'): ?> 邮箱*
                                    <?php elseif ($this->options->langis == '2'): ?> 邮箱*
                                    <?php endif; ?>
                                </label>
                </div>
            </div>

            <!-- Input website -->
            <div class="login-form-group">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input type="url" name="url" id="visitor-url" class="mdl-textfield__input login-input-info" />
                    <!--  placeholder="http://"-->
                    <label for="url" class="mdl-textfield__label">
                                    <?php if ($this->options->langis == '0'): ?> Website
                                    <?php elseif ($this->options->langis == '1'): ?> 网站
                                    <?php elseif ($this->options->langis == '2'): ?> 邮箱*
                                    <?php endif; ?>
                                </label>
                </div>
            </div>
            <div class="cancel-comment-reply">
                <?php $comments->cancelReply(); ?>
            </div>

            <?php endif; ?>

            <!-- Input comment content -->
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="comment-input-div" style="width: 90%;">
                <textarea name="text" rows="1" id="comment" class="mdl-textfield__input"></textarea>
                <label for="comment" class="mdl-textfield__label">
                            <?php if ($this->options->langis == '0'): ?> Join the discussion
                            <?php elseif ($this->options->langis == '1'): ?> 加入讨论吧...
                            <?php elseif ($this->options->langis == '2'): ?> 加入讨论吧...
                            <?php endif; ?>
                        </label>
            </div>

            <!-- Submit comment content button -->
            <span style="width: 10%;">
            <?php $comments->reply('
                    <button id="comment-button" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                        <i class="material-icons" role="presentation">check</i><span class="visuallyhidden">add comment</span>
                    </button>'); ?>
            <div class="mdl-tooltip" for="comment-button">
                <?php if ($this->options->langis == '0'): ?> Submit
                <?php elseif ($this->options->langis == '1'): ?> 提交
                <?php elseif ($this->options->langis == '2'): ?> 提交
                <?php endif; ?>
            </div>
            </span>


        </form>
    </div>


    <?php else: ?>

    <div class="comments__closed">
        <span id="commentCount">评论已被关闭</span>
    </div>

    <?php endif; ?>
</div>
