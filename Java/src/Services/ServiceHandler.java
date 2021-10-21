package Services;

import base.Entry;
import base.Product;
import java.io.IOException;
import java.time.LocalDate;
import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;


public class ServiceHandler{
    
    private final String pricetag;
    private final String currencytag;
    
    public ServiceHandler(String pricetag, String currtag){
        this.pricetag = pricetag;
        this.currencytag = currtag;
    }
    
    public Entry getEntry(Product product) throws IOException, NullPointerException{
        Document doc = Jsoup.connect(product.getUrl())
                .userAgent("Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:93.0) Gecko/20100101 Firefox/93.0")
                .cookie("auth", "token")
                .timeout(3000)
                .get();
        double price = Double.parseDouble(doc.getElementById(pricetag).val()) / 100;
        String currency = doc.getElementById(currencytag).val();
        Entry entry = new Entry(LocalDate.now(), price, product.getId(), currency);
        return entry;
    }
}
