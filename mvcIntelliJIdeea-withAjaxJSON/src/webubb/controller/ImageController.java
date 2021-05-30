package webubb.controller;

import org.json.simple.JSONArray;
import org.json.simple.JSONObject;
import webubb.domain.ImagePuzzle;
import webubb.domain.Piece;
import webubb.domain.User;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.Collections;
import java.util.Comparator;
import java.util.List;
import java.util.stream.Collectors;

public class ImageController extends HttpServlet {

    private ImagePuzzle imagePuzzle = new ImagePuzzle();

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        String action = request.getParameter("action");
        HttpSession session=request.getSession();
        List<Piece> puzzle = (List<Piece>) session.getAttribute("puzzle");
        User user = (User)session.getAttribute("user");
        System.out.println("ba");
        System.out.println(user.getUsername());

        if ((action != null) && action.equals("startGame")) {

            var gridSize = imagePuzzle.getGridSize();
            var image = imagePuzzle.randomImage();
            imagePuzzle.setSelectedImage(image);


            this.getPos(puzzle  , gridSize);
            Collections.shuffle(puzzle);


            response.setContentType("application/json");
            JSONArray jsonArray  = sendPuzzleResponse(puzzle,gridSize, image);
            PrintWriter out = new PrintWriter(response.getOutputStream());
            out.println(jsonArray.toJSONString());
            out.flush();


        }
        if ((action != null) && action.equals("increase")) {
            Integer nrmoves = Integer.parseInt(request.getParameter("puzzle"));
            nrmoves+=1;

            PrintWriter out = new PrintWriter(response.getOutputStream());
            out.println(nrmoves);
            out.flush();
        }
        if ((action != null) && action.equals("move")) {
            Integer selected1 = Integer.parseInt(request.getParameter("selected1"));
            Integer selected2 = Integer.parseInt(request.getParameter("selected2"));

            Piece s1 = puzzle.stream()
                    .filter(p -> p.getPosition() == selected1).collect(Collectors.toList()).get(0);
            Piece s2 = puzzle.stream()
                    .filter(p -> p.getPosition() == selected2).collect(Collectors.toList()).get(0);

            Integer i = puzzle.indexOf(s1);
            Integer j = puzzle.indexOf(s2);
            
            Collections.swap(puzzle, i, j);

            response.setContentType("application/json");
            JSONArray jsonArray  = sendPuzzleResponse(puzzle, imagePuzzle.getGridSize(), imagePuzzle.getImage());
            PrintWriter out = new PrintWriter(response.getOutputStream());
            out.println(jsonArray.toJSONString());
            out.flush();
            

        }
        if ( (action != null) && action.equals("checkFinish"))
        {
            if ( finishedGame(puzzle, puzzle))
            {
                response.setContentType("application/json");
                JSONObject jObj = new JSONObject();
                jObj.put("result",true);
                PrintWriter out = new PrintWriter(response.getOutputStream());
                out.println(jObj.toJSONString());
                out.flush();


            }
            else
            {

                imagePuzzle.setStepCount(imagePuzzle.getStepCount()+1);
                session.setAttribute("stepCount", imagePuzzle.getStepCount());
                JSONObject jObj = new JSONObject();
                jObj.put("result", false);
                jObj.put("stepCount",imagePuzzle.getStepCount());
                PrintWriter out = new PrintWriter(response.getOutputStream());
                out.println(jObj.toJSONString());
                out.flush();

            }
        }


    }

    private JSONArray sendPuzzleResponse(List<Piece>puzzle, Integer gridSize, String image) {

        JSONArray jsonArray = new JSONArray();
        puzzle.forEach(p->{ JSONObject jObj = new JSONObject();
            jObj.put("xpos", p.getXpos());
            jObj.put("ypos", p.getYpos());
            jObj.put("gridSize", gridSize);
            jObj.put("image", image);
            jObj.put("id", p.getPosition());
            jsonArray.add(jObj);});
        return jsonArray;
    }

    private void getPos(List<Piece> puzzle, Integer gridSize){



        var percentage = 100 / (gridSize - 1);
        for (Integer i = 0; i < gridSize * gridSize; i++) {
            Integer xpos = (percentage * (i % gridSize));
            Integer ypos = (percentage * (i / gridSize));
            Piece piece = new Piece(xpos, ypos, i);
            puzzle.add(piece);
        }

    }



    public boolean finishedGame(List<Piece> puzzle, List<Piece> playerPuzzle){
        List<Piece> sorted = puzzle.stream()
                .sorted(Comparator.comparing(Piece::getPosition))
                .collect(Collectors.toList());

        return playerPuzzle.equals(sorted);
    }



}
