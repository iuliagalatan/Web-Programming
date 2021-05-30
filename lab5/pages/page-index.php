<h1> Document List </h1>

<?php
    $query = "SELECT * FROM documents"; //acest query trebuie modificat
    $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) == 0)
    {
        print("Niciun rezultat returnat!!!!!!!!!!!");
    }
    else
    {
        ?>
        <table class="table">
            <thead>
                <tr>
                    <td>
                        Id
                    </td>
                    <td>
                        Author
                    </td>
                    <td>
                        Title
                    </td>
                    <td>
                        NR.Pages
                    </td>
                    <td>
                        Format
                    </td>
                    <td>
                       Type
                    </td>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                    $cnt = 0;
                    while($l = mysqli_fetch_array($result))
                    {
                        $cnt++;
                        ?>
                        <tr>
                            <td>
                                <?=$cnt?>
                            </td>
                            <td>
                                <?=$l['Author']?>
                            </td>
                            <td>
                                <?=$l['Title']?>
                            </td>
                            <td>
                                <?=$l['Nr.Pages']?>
                            </td>
                            <td>
                                <?=$l['Format']?>
                            </td>
                            <td>
                                <?=$l['Type']?>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
            
            
        </table>       
        <?php 
    }
?>