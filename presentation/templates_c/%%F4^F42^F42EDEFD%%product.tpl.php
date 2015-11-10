<?php /* Smarty version 2.6.28, created on 2014-09-17 12:53:11
         compiled from product.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'load_presentation_object', 'product.tpl', 1, false),array('modifier', 'print_r', 'product.tpl', 29, false),)), $this); ?>
<?php echo smarty_function_load_presentation_object(array('filename' => 'product','assign' => 'obj'), $this);?>


<h1 class="title"><?php echo $this->_tpl_vars['obj']->mProduct['name']; ?>
</h1>
<?php if ($this->_tpl_vars['obj']->mProduct['image']): ?>
    <img class="product-image" src="<?php echo $this->_tpl_vars['obj']->mProduct['image']; ?>
"
    alt="<?php echo $this->_tpl_vars['obj']->mProduct['name']; ?>
 image" />
<?php endif; ?>
<?php if ($this->_tpl_vars['obj']->mProduct['image_2']): ?>
    <img class="product-image" src="<?php echo $this->_tpl_vars['obj']->mProduct['image_2']; ?>
"
    alt="<?php echo $this->_tpl_vars['obj']->mProduct['name']; ?>
 image 2" />
<?php endif; ?>
<p class="description"><?php echo $this->_tpl_vars['obj']->mProduct['description']; ?>
</p
<p class="section">
    Price:
    <?php if ($this->_tpl_vars['obj']->mProduct['discounted_price'] != 0): ?>
        <span class="old-price"><?php echo $this->_tpl_vars['obj']->mProduct['price']; ?>
</span>
        <span class="price"><?php echo $this->_tpl_vars['obj']->mProduct['discounted_price']; ?>
</span>
    <?php else: ?>
        <span class="price"><?php echo $this->_tpl_vars['obj']->mProduct['price']; ?>
</span>
    <?php endif; ?>
</p>

<p class="attributes">

        <?php unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['obj']->mProduct['attributes']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['l']['show'] = true;
$this->_sections['l']['max'] = $this->_sections['l']['loop'];
$this->_sections['l']['step'] = 1;
$this->_sections['l']['start'] = $this->_sections['l']['step'] > 0 ? 0 : $this->_sections['l']['loop']-1;
if ($this->_sections['l']['show']) {
    $this->_sections['l']['total'] = $this->_sections['l']['loop'];
    if ($this->_sections['l']['total'] == 0)
        $this->_sections['l']['show'] = false;
} else
    $this->_sections['l']['total'] = 0;
if ($this->_sections['l']['show']):

            for ($this->_sections['l']['index'] = $this->_sections['l']['start'], $this->_sections['l']['iteration'] = 1;
                 $this->_sections['l']['iteration'] <= $this->_sections['l']['total'];
                 $this->_sections['l']['index'] += $this->_sections['l']['step'], $this->_sections['l']['iteration']++):
$this->_sections['l']['rownum'] = $this->_sections['l']['iteration'];
$this->_sections['l']['index_prev'] = $this->_sections['l']['index'] - $this->_sections['l']['step'];
$this->_sections['l']['index_next'] = $this->_sections['l']['index'] + $this->_sections['l']['step'];
$this->_sections['l']['first']      = ($this->_sections['l']['iteration'] == 1);
$this->_sections['l']['last']       = ($this->_sections['l']['iteration'] == $this->_sections['l']['total']);
?>
        <pre><?php echo print_r($this->_tpl_vars['obj']->mProduct['attributes']); ?>
</pre>
                <?php if ($this->_sections['l']['first'] || $this->_tpl_vars['obj']->mProduct['attributes'][$this->_sections['l']['index']]['attribute_name'] != $this->_tpl_vars['obj']->mProduct['attributes'][$this->_sections['l']['index_prev']]['attribute_name']): ?>
            <?php echo $this->_tpl_vars['obj']->mProduct['attributes'][$this->_sections['l']['index']]['attribute_name']; ?>
:
            <select name="attr_<?php echo $this->_tpl_vars['obj']->mProduct['attributes'][$this->_sections['l']['index']]['attributes_name']; ?>

        <?php endif; ?>

                <option value="<?php echo $this->_tpl_vars['obj']->mProduct['attributes'][$this->_sections['l']['index']]['attribute_value']; ?>
">
            <?php echo $this->_tpl_vars['obj']->mProduct['attributes'][$this->_sections['l']['index']]['attribute_value']; ?>

        </option>

         
        <?php if ($this->_sections['l']['last'] || $this->_tpl_vars['obj']->mProduct['attributes'][$this->_sections['l']['index']]['attribute_name'] !== $this->_tpl_vars['obj']->mProduct['attributes'][$this->_sections['l']['index_next']]['attribute_name']): ?>
            </select>
        <?php endif; ?>

     <?php endfor; endif; ?>
</p>

<?php if ($this->_tpl_vars['obj']->mLinkToContinueShopping): ?>
    <a href="<?php echo $this->_tpl_vars['obj']->mLinkToContinueShopping; ?>
">Continue Shopping</a>
<?php endif; ?>

<h2>Find similar products in our catalog:</h2>
<ol>
    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['obj']->mLocations) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
        <li class="navigation">
            <?php echo '<a href="'; ?><?php echo $this->_tpl_vars['obj']->mLocations[$this->_sections['i']['index']]['link_to_department']; ?><?php echo '">'; ?><?php echo $this->_tpl_vars['obj']->mLocations[$this->_sections['i']['index']]['department_name']; ?><?php echo '</a>'; ?>

                        &raquo;
            <?php echo '<a href="'; ?><?php echo $this->_tpl_vars['obj']->mLocations[$this->_sections['i']['index']]['link_to_category']; ?><?php echo '">'; ?><?php echo $this->_tpl_vars['obj']->mLocations[$this->_sections['i']['index']]['category_name']; ?><?php echo '</a>'; ?>

        </li>
    <?php endfor; endif; ?>
</ol>