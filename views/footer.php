</div>
        <?php
            $dir = 'views/' . $this->name . '/js/';
            if((file_exists($dir)) && !empty($dir)) {
                $js = glob($dir . '*.js');
                foreach($js as $j) {
                    echo "<script src=\"" . URL . $j . "\"></script>\n";
                }
            }
        ?>
        <script>
        
            $(document).ready(function() {
                classes = ['Druid','Hunter','Mage','Paladin','Priest','Rogue','Shaman','Warlock','Warrior','Neutral'];
                $('#Neutral').hide();
                $('input[type=button]').click(function(event) {
                    className = $(event.target).attr('name');
                    for(var i = 0; i < classes.length; i++) {
                        $('#' + classes[i]).hide();
                    }
                    $('#' + className).show();
                });
            });
            
        </script>
    </body>
</html>