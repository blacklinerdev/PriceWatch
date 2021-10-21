package base;

import java.time.LocalDate;

public class Entry {
    
    private final LocalDate date;
    private final double price;
    private final int productId;
    private final String currency;
    
    public Entry(LocalDate date, double price, int productId, String currency){
        this.date = date;
        this.price = price;
        this.productId = productId;
        this.currency = currency;
    }

    public LocalDate getDate() {
        return date;
    }

    public double getPrice() {
        return price;
    }
    public int getProductId(){
        return this.productId;
    }
    public String getCurrency(){
        return this.currency;
    }
}
