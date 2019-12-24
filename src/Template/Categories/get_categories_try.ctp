<dl>
    <?php foreach ($categories as $category): ?>
        <li value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?>
            <dl>
                <?php foreach ($category->subcategories as $subCategory): ?>
                    <li value="<?php echo $subCategory['id']; ?>"><?php echo $subCategory['name']; ?>
                <?php endforeach; ?>            
            </dl>
        </li>
    <?php endforeach; ?>
</dl>
