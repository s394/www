<?php
// $Id: node.tpl.php,v 1.4.2.1 2009/05/12 18:41:54 johnalbin Exp $

/**
 * @file node.tpl.php
 *
 * Theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: Node body or teaser depending on $teaser flag.
 * - $picture: The authors picture of the node output from
 *   theme_user_picture().
 * - $date: Formatted creation date (use $created to reformat with
 *   format_date()).
 * - $links: Themed links like "Read more", "Add new comment", etc. output
 *   from theme_links().
 * - $name: Themed username of node author output from theme_user().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $submitted: themed submission information output from
 *   theme_node_submitted().
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $teaser: Flag for the teaser state.
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 */
?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"><div class="node-inner">

  <?php print $picture; ?>

  <?php if (!$page): ?>
    <h2 class="title">
      <a href="<?php print $node_url; ?>" title="<?php print $title ?>"><?php print $title; ?></a>
    </h2>
  <?php endif; ?>

  <?php if ($unpublished): ?>
    <div class="unpublished"><?php print t('Unpublished'); ?></div>
  <?php endif; ?>

  <?php if ($submitted || $terms): ?>
    <div class="meta">
      <?php if ($submitted): ?>
        <div class="submitted">
          <?php print $submitted; ?>
        </div>
      <?php endif; ?>

      <?php if ($terms): ?>
        <div class="terms terms-inline"><?php print t(' in ') . $terms; ?></div>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <div class="content">
    <?php print $node->content['og_mission']['#value']; ?>
    
    <ul class="group-tabs">
      <li><a href="#">Activity</a></li>
      <li><a href="#">Events</a></li>
      <li><a href="#">Discussion</a></li>
      <li><a href="#">Members</a></li>
    </ul>

    <div class="group-panes">
      <div id="activity">
        <?php echo views_embed_view('group_activity', 'default', $node->nid) ?>
      </div>
      <div id="events">
        <?php echo views_embed_view('events', 'default', array($node->nid)) ?>
      </div>
      <div id="discussion">
        <?php echo views_embed_view('forum', 'default', $node->nid) ?>
      </div>
      <div id="members">
        <?php echo views_embed_view('og_members', 'block_1', $node->nid) ?>
      </div>
    </div>
  </div>
  
  <div id="recent-members">
    <h2 class="title">Members</h2>
    <?php echo views_embed_view('og_members_block', 'block_1', $node->nid) ?>
  </div>

  <?php print $links; ?>

</div></div> <!-- /node-inner, /node -->

<?php if ($node->field_subtitle && count($node->field_subtitle) > 0): ?>
  <!-- show the subtitle, if there is one -->
  <div id="subtitle" style="display:none;">
    <h2><?php print $node->field_subtitle[0]['value']; ?></h2>
  </div> <!-- subtitle -->
<?php endif ?>