package base;

import Services.AmazonHandler;
import Services.ServiceHandler;
import io.SQLHandler;
import java.io.IOException;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;

public class Crawler {

    public static void main(String[] args) {
        //declare variables
        SQLHandler sql;
        List<Product> products;
        List<Entry> entries;
        ServiceHandler handler;
        //init values
        try {
            sql = new SQLHandler();
            //load products from database
            products = sql.getProducts();
            entries = new ArrayList();
            handler = new AmazonHandler();
            //crawl price for each product from webpage
            products.forEach(product -> {
                try {
                    entries.add(handler.getEntry(product));
                } catch (IOException | NullPointerException ex) {
                    Logger.getLogger(Crawler.class.getName()).log(Level.SEVERE, "No price found", ex);
                }
            });
        } catch (SQLException ex) {
            Logger.getLogger(Crawler.class.getName()).log(Level.SEVERE, null, ex);
            return;
        }
        //write each entry to database
        entries.forEach(entry -> {
            sql.sendEntry(entry);
        });
    }
}
