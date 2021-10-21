package base;

public class Product {
    
    private final String name;
    private final String url;
    private final int id;
    
    public Product( int id ,String name, String url){
        this.name = name;
        this.url = url;
        this.id = id;
    }

    public String getName() {
        return name;
    }

    public String getUrl() {
        return url;
    }
    
    public int getId(){
        return this.id;
    }
}
