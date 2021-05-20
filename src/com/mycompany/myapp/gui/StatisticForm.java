package com.mycompany.myapp.gui;

import com.codename1.charts.ChartComponent;
import com.codename1.charts.models.CategorySeries;
import com.codename1.charts.renderers.DefaultRenderer;
import com.codename1.charts.renderers.SimpleSeriesRenderer;
import com.codename1.charts.util.ColorUtil;
import com.codename1.charts.views.PieChart;
import com.codename1.charts.views.LineChart;
import com.codename1.ui.Button;
import com.codename1.ui.Command;
import com.codename1.ui.Container;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.util.Resources;
import com.mycompany.myapp.entities.Ev;
import com.mycompany.myapp.services.GererEv;
import java.util.ArrayList;

/**
 *
 * @author Firas
 */
public class StatisticForm extends Form{
    ArrayList<Ev> data = new ArrayList<>();
    /**
 * Creates a renderer for the specified colors.
 */
private DefaultRenderer buildCategoryRenderer(int[] colors) {
    DefaultRenderer renderer = new DefaultRenderer();
    renderer.setLabelsTextSize(15);
    renderer.setLegendTextSize(15);
    renderer.setMargins(new int[]{20, 30, 15 , 0});
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
protected CategorySeries buildCategoryDataset(String title, ArrayList<Ev> data) {
   CategorySeries series = new CategorySeries(title);
    data = GererEv.getInstance().getAllEvents();
    int pt=0;
    int pc=0;
    int pr=0;
    
        for (int i = 0; i < data.size(); i++) {
            if (data.get(i).getType_ev().equals("sportif"))
                pt=pt+1;
            if (data.get(i).getType_ev().equals("educatif"))
                pc=pc+1;
            if (data.get(i).getType_ev().equals("loisir"))
                pr=pr+1;
           
        }
        
        series.add("Sportif", pt);
        series.add("Educatif", pc);
        series.add("loisir", pr);
      
    return series;
}

    public StatisticForm(Resources res) {
    // Set up the renderer
    int[] colors = new int[]{ColorUtil.YELLOW, ColorUtil.MAGENTA,ColorUtil.CYAN};
    DefaultRenderer renderer = buildCategoryRenderer(colors);
    renderer.setChartTitleTextSize(80);
    renderer.setDisplayValues(true);
    renderer.setShowLabels(true);
    SimpleSeriesRenderer r = renderer.getSeriesRendererAt(0);
    
renderer.setLabelsTextSize(50);
    renderer.setLegendTextSize(60);
    renderer.setChartTitle("Les Types des evenements");
    renderer.setLabelsColor(12345);
    renderer.setBackgroundColor(12346);
    // Create the chart ... pass the values and renderer to the chart object.
    PieChart chart = new PieChart(buildCategoryDataset("Nombre des types des evenements ", data), renderer);

    // Wrap the chart in a Component so we can add it to a form
    ChartComponent c = new ChartComponent(chart);

        // Create a form and show it.
        Container add = add(c);
     Button btnAnnuler = new Button("Annuler");
         btnAnnuler.addActionListener(e -> {
             new EvenementListForm(res).show();
         });
         Container content = BoxLayout.encloseY(
                 btnAnnuler
         );
         add(content);
}
}

