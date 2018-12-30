            <div id="rightCol">
                <div id="mCurve">
                    <table>
                        <?php
                            for($x = 0; $x <= 7; $x++) {
                                echo "<tr>
                                    <td>";
                                if($x == 7) {
                                    echo '7+';
                                } else {
                                    echo $x;
                                }
                                echo "</td>
                                    <td class=\"manaContainer\"><div class=\"mana\" mana=\"$x\"></div></td>
                                    <td id=\"mCurve$x\">0</td>
                                </tr>";
                            }
                        ?>
                    </table>
                </div>
                <table id="pCards">
                    <tr>
                        <td COLSPAN="2" class="totalList">Total Cards:</td>
                        <td class="totalListA">0</td>
                    </tr>
                </table>
            </div>
            <div id="content">
                <div id="classes">
                    <input type="button" id="ClassButton" name="Class" value="<?php echo $this->class; ?>" onclick="paginate('<?php echo URL ?>',1,'<?php echo $this->class ?>')" />
                    <input type="button" id="NeutralButton" name="Neutral" value="Neutral" onclick="paginate('<?php echo URL ?>',1,'Neutral')" />
                </div>
                <div id="cardList">
                    <div id="cardCollection">
                        <?php
                            foreach ($this->cardCollection as $row) {
                                echo "<img src=\"" . URL . "public/images/cards/" . $row['img'] . ".png\" class=\"card\" card=\"" . $row['name'] . "\" c_id=\"" . $row['id'] . "\" mana=\"" . $row['mana'] . "\" type=\"" . $row['type'] . "\" />\n";
                            }
                        ?>
                    </div>
                </div>
                <div id="classPaginate">
                    <?php
                        $amount = ceil($this->totalClass / 8);
                        for ($i = 1; $i <= $amount; $i++) {
                            echo "<input type=\"button\" value=\"$i\" onclick=\"paginate('" . URL . "',$i,'" . $this->class . "')\" />";
                        }
                    ?>
                </div>
                <div id="neutralPaginate">
                    <?php
                        $amount = ceil($this->totalNeutral / 8);
                        for ($i = 1; $i <= $amount; $i++) {
                            echo "<input type=\"button\" value=\"$i\" onclick=\"paginate('" . URL . "',$i,'Neutral')\" />";
                        }
                    ?>
                </div>
            </div>
            