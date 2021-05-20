/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package gui;

import com.codename1.charts.ChartComponent;
import com.codename1.charts.models.CategorySeries;
import com.codename1.charts.renderers.DefaultRenderer;
import com.codename1.charts.renderers.SimpleSeriesRenderer;
import com.codename1.charts.util.ColorUtil;
import com.codename1.charts.views.PieChart;
import com.codename1.components.FloatingHint;
import com.codename1.ui.Button;
import com.codename1.ui.Container;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.util.Resources;
import com.mycompany.entities.Article;
import com.mycompany.services.ServiceArticles;

import java.util.ArrayList;


/**
 *
 * @author ASuS
 */
public class StatForm extends BaseForm {
    ArrayList<Article> data = new ArrayList<>();
    /**
 * Creates a renderer for the specified colors.
 */
private DefaultRenderer buildCategoryRenderer(int[] colors) {
    DefaultRenderer renderer = new DefaultRenderer();
    renderer.setLabelsTextSize(15);
    renderer.setLegendTextSize(15);
    renderer.setMargins(new int[]{20, 30, 15, 0});
    for (int color : colors) {
        SimpleSeriesRenderer r = new SimpleSeriesRenderer();
        r.setColor(color);
        renderer.addSeriesRenderer(r);
    }
    return renderer;
}

/**
 * Builds a category series using the provided values.
 *
 * @param titles the series titles
 * @param values the values
 * @return the category series
 */
    protected CategorySeries buildCategoryDataset(String title, ArrayList<Article> data) {
    CategorySeries series = new CategorySeries(title);
    data = ServiceArticles.getInstance().getAllTasks();
    int pt=0;
    int pc=0;
   
        for (int i = 0; i < data.size(); i++) {
            if (data.get(i).getAuteur_art().equals("mgknutri"))
                pt=pt+1;
            if (data.get(i).getAuteur_art().equals("mgkcoach"))
                pc=pc+1;
           
        }
       series.add("mgknutri", pc);
        series.add("mgkcoach", pt);
        
       
    return series;
}

    public StatForm(Resources res ) {
        setLayout(BoxLayout.y());
    // Set up the renderer
    int[] colors = new int[]{ColorUtil.BLUE, ColorUtil.GREEN, ColorUtil.MAGENTA, ColorUtil.YELLOW, ColorUtil.CYAN};
    DefaultRenderer renderer = buildCategoryRenderer(colors);
 
  renderer.setLabelsTextSize(50);
    
    renderer.setChartTitle("Nombre d'articles par auteurs");
    renderer.setLabelsColor(12345);
    renderer.setBackgroundColor(12346);
   
    renderer.setChartTitleTextSize(80);
    renderer.setDisplayValues(true);
    renderer.setShowLabels(true);
    SimpleSeriesRenderer r = renderer.getSeriesRendererAt(0);
    r.setGradientEnabled(true);
    r.setGradientStart(0, ColorUtil.BLUE);
    r.setGradientStop(0, ColorUtil.GREEN);
    r.setHighlighted(true);
   

    // Create the chart ... pass the values and renderer to the chart object.
    PieChart chart = new PieChart(buildCategoryDataset("Nombre d'articles par auteurs", data), renderer);

    // Wrap the chart in a Component so we can add it to a form
    ChartComponent c = new ChartComponent(chart);

    // Create a form and show it.
 
    add(c);
    
//      getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_BACK
//                , e-> previous.showBack()); // Revenir vers l'interface précédente
  Button btnAnnuler = new Button("Annuler");
         btnAnnuler.addActionListener(e -> {
             new ListProduitsForm(res).show();
         });
         
         Container content = BoxLayout.encloseY(
                 
                 
                 btnAnnuler
         );
         
         add(content);
}
    
}
