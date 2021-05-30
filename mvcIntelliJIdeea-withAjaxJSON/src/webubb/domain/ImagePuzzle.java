package webubb.domain;

import java.util.ArrayList;
import java.util.Random;

public class ImagePuzzle {
    private Integer stepCount;
    private ArrayList<String> images;
    private Integer gridSize;
    private String selectedImage;

    public ImagePuzzle(Integer stepCount, ArrayList<String> images, Integer g) {
        this.stepCount = stepCount;
        this.images = images;
        this.gridSize = g;
    }

    public ImagePuzzle() {
        gridSize = 4;
        stepCount = 0;
        images = new ArrayList<String>();
        images.add("images/london-bridge.jpg");

        images.add("images/heidi4.jpg");
        images.add("images/heidi5.jpg");

        images.add("images/heidi6.jpg");


    }

    public String getImage()
    {
        return selectedImage;
    }

    public void setSelectedImage(String selectedImage) {
        this.selectedImage = selectedImage;
    }

    public String randomImage(){
        int rnd = new Random().nextInt(images.size());
       return images.get(rnd);
    }
    public Integer getGridSize() {
        return gridSize;
    }

    public void setGridSize(Integer gridSize) {
        this.gridSize = gridSize;
    }

    public Integer getStepCount() {
        return stepCount;
    }

    public void setStepCount(Integer stepCount) {
        this.stepCount = stepCount;
    }

    public ArrayList<String> getImages() {
        return images;
    }

    public void setImages(ArrayList<String> images) {
        this.images = images;
    }
}
