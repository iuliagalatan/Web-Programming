<%@ page import="webubb.domain.User" %>
<%@ page import="webubb.domain.ImagePuzzle"%>
<%@ page import="java.util.ArrayList" %>
<%@ page import="webubb.domain.Piece" %>
<%@ page import="java.util.List" %>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Puzzle</title>


    <script src="js/jquery-2.0.3.js"></script>
    <script src="js/ajax_utils.js"></script>

</head>
<body>
<%! User user; %>
<%  user = (User) session.getAttribute("user");

    if(user == null)
    {
        response.sendRedirect("error.jsp");
    }
    if (user != null) {
        System.out.println("Welcome " + user.getUsername());
        ImagePuzzle puzzle = new ImagePuzzle();
        session.setAttribute("puzzle", new ArrayList<Piece>());
        session.setAttribute("stepCount", 0);

        
%>
<script src="js/ajax_utils.js"></script>
<link rel="stylesheet" href="css/style.css">
    <div id="collage">
        <h2>Image Puzzle</h2>
        <hr/>

        <div id="playPanel" style="padding:5px;">
            <hr />
            <div style="display:inline-block; margin:auto; width:95%; vertical-align:top;">
                <ul id="sortable" class="sortable"></ul>
            </div>
            <div id="box" style="display:none;">
            <h3 id="nrMoves">Moves:<h3 id="stepCount"></h3></h3></div>
            <button id="btn">start Game</button>

        </div>
        <button id="logOut">LogOut</button>
    </div>

</body>
</html>
<%
    }
    %>
<script>

    var selected1 = -1, selected2 = -1;
    $(document).ready(function(){
        $("#sortable").on("click","li",function() {
            console.log(this.id)
            if(selected1 === -1)
            {
                selected1 = this.id;
            }
            else
                if(selected2 === -1)
                {
                    selected2 = this.id;

                    move(selected1, selected2,function (response) {

                        $("#sortable").empty();
                        for (let i in response) {

                            let li = createLittleSquare(response[i]);

                            $("#sortable").append(li);
                        }
                    checkFinish(function(resp){

                       if(resp.result === true)
                       {
                           alert("Congrats you finished the game!");

                       }
                       else
                       {

                           document.getElementById("stepCount").innerHTML = resp.stepCount;
                       }
                    });

                    });
                    selected1 = -1;
                    selected2 = -1;

                }
        });

    });


    function createLittleSquare(littleSquare) {


        let li = document.createElement('li');

        li.setAttribute('id', littleSquare.id);

        li.style.backgroundImage = 'url(' + littleSquare.image + ')';
        li.style.backgroundSize = (littleSquare.gridSize * 100) + '%';
        li.style.backgroundPosition = littleSquare.xpos + '% ' + littleSquare.ypos + '%';
        li.style.width = 400 / littleSquare.gridSize + 'px';
        li.style.height = 400 / littleSquare.gridSize + 'px';
        li.style.border = '1px solid';
        return li;
    }

    $(document).ready(function() {
        $("#btn").click(function() {
            document.getElementById("btn").style.display = "none";
            document.getElementById("box").style.display = "block";
            document.getElementById("sortable").style.display = "inline-block";

            startGame(1, function (response) {
                console.log(response);

                for (let i in response) {

                    let li = createLittleSquare(response[i]);

                    $("#sortable").append(li);
                }

            });
        })

    })
    document.getElementById("logOut").onclick = function () {
        sessionStorage.clear();
        location.href = "index.html";
    };
</script>