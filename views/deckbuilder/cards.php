<span id="cardCollection">
    <?php
        foreach ($this->cardCollection as $row) {
            echo "<img src=\"" . URL . "public/images/cards/" . $row['img'] . ".png\" class=\"card\" card=\"" . $row['name'] . "\" c_id=\"" . $row['id'] . "\" mana=\"" . $row['mana'] . "\" type=\"" . $row['type'] . "\" />\n";
        }
    ?>
</span>
