package webubb.domain;

public class Piece {
    private Integer xpos;
    private Integer ypos;
    private Integer position;

    public Piece(Integer xpos, Integer ypos, Integer position) {
        this.xpos = xpos;
        this.ypos = ypos;
        this.position = position;
    }

    public Piece() {
    }

    public Integer getPosition(){
        return position;
    }

    public Integer getXpos() {
        return xpos;
    }

    public void setXpos(Integer xpos) {
        this.xpos = xpos;
    }

    public Integer getYpos() {
        return ypos;
    }

    public void setYpos(Integer ypos) {
        this.ypos = ypos;
    }
}
