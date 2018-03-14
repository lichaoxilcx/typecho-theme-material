<?php $this->comments()->to($comments); ?>
<?php function threadedComments($comments, $options)
{
    global $language;
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
				$comments->reply($GLOBALS['language'][$options->langis]['reply']);
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
            <p style="color:#8A8A8A;" class="visitor-name-span"><?php echo $language[$this->options->langis]['logged_in_as']; ?>
                <a href="<?php $this->options->adminUrl(); ?>" style="font-weight:400"><?php $this->user->screenName(); ?></a>.
                <a href="<?php $this->options->logoutUrl(); ?>" title="Logout" style="font-weight:400"><?php echo $language[$this->options->langis]['logout']; ?> &raquo;</a>
                <?php $comments->cancelReply($language[$this->options->langis]['cancel_reply']); ?>
            </p>

            <!-- If user didn't login -->
            <?php else: ?>

            <!-- Input name -->
            <div class="login-form-group">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input type="text" name="author" class="mdl-textfield__input login-input-info" />
                    <label for="author" class="mdl-textfield__label">
                        <?php echo $language[$this->options->langis]['name']; ?>*
                    </label>
                </div>
            </div>

            <!-- Input email -->
            <div class="login-form-group">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input type="email" name="mail" class="mdl-textfield__input login-input-info" />
                    <label for="mail" class="mdl-textfield__label">
                        <?php echo $language[$this->options->langis]['email']; ?>*
                    </label>
                </div>
            </div>

            <!-- Input website -->
            <div class="login-form-group">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input type="url" name="url" id="visitor-url" class="mdl-textfield__input login-input-info" />
                    <!--  placeholder="http://"-->
                    <label for="url" class="mdl-textfield__label">
                        <?php echo $language[$this->options->langis]['website']; ?>*
                    </label>
                </div>
            </div>
            <div class="cancel-comment-reply">
                <?php $comments->cancelReply($language[$this->options->langis]['cancel_reply']); ?>
            </div>

            <?php endif; ?>

            <!-- Input comment content -->
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="comment-input-div">
                <textarea name="text" rows="1" id="comment" class="mdl-textfield__input"></textarea>
                <label for="comment" class="mdl-textfield__label">
                        <?php echo $language[$this->options->langis]['join_the_discussion']; ?>
                        </label>
            </div>

            <!-- Submit comment content button -->
            <span>
            <?php $comments->reply('
                    <button id="comment-button" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                        <i class="material-icons" role="presentation">check</i><span class="visuallyhidden">add comment</span>
                    </button>'); ?>
            <div class="mdl-tooltip" for="comment-button">
                <?php echo $language[$this->options->langis]['submit']; ?>
            </div>
            </span>


        </form>
    </div>


    <?php else: ?>

    <div class="comments__closed">
        <span id="commentCount"><?php echo $language[$this->options->langis]['comment_has_been_closed']; ?></span>
    </div>

    <?php endif; ?>

</div>
