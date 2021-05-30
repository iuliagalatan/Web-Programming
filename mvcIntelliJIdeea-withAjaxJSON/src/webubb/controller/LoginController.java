package webubb.controller;

/**
 * Created by forest.
 */


import java.io.IOException;
import java.util.ArrayList;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import webubb.domain.Piece;
import webubb.model.DBManager;
import webubb.domain.User;



public class LoginController extends HttpServlet {

    public LoginController() {
        super();
    }

    protected void doPost(HttpServletRequest request,
                          HttpServletResponse response) throws ServletException, IOException {

        String username = request.getParameter("username");
        String password = request.getParameter("password");
        RequestDispatcher rd = null;

        DBManager dbmanager = new DBManager();
        User user = dbmanager.authenticate(username, password);
        if (user != null) {
            rd = request.getRequestDispatcher("/succes.jsp");

            HttpSession session = request.getSession();
            session.setAttribute("user", user);
            session.setAttribute("puzzle", new ArrayList<Piece>());
            session.setAttribute("stepCount", 0);

        } else {
            rd = request.getRequestDispatcher("/error.jsp");
        }
        rd.forward(request, response);
    }

}