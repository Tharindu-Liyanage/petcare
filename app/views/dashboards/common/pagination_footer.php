 <!-- table footer here -->
                
 <footer> 
                    <span>Showing <span class="foot-number">

                    <?php if( count($data[$current_page]) >= 5) {

                    echo ' 
                    <select class="show-entries">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                    </select>

                    </span> of <span class="foot-number">' . count($data[$current_page]) . '</span> entries</span>

                    
                    <div class="pagination-main">
                        <ul class="pagination"></ul>
                    </div>
                    ';


                    }else {


                        echo    count($data[$current_page]) . '</span> of <span class="foot-number">' . count($data[$current_page]) . '</span> entries</span>
                        
                                <div class="pagination-main">
                               
                              
                                    <ul class="pagination"></ul>
                      

                                </div>
                        ';


                    } ?>

    
                </footer>