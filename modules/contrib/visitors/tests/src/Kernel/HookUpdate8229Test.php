<?php

declare(strict_types=1);

namespace Drupal\Tests\visitors\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Symfony\Component\Yaml\Yaml;

require_once __DIR__ . '/../../../visitors.install';

/**
 * Tests the hook_update_8229() function.
 *
 * @group visitors
 */
class HookUpdate8229Test extends KernelTestBase {


  /**
   * {@inheritdoc}
   */
  protected $strictConfigSchema = FALSE;

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'visitors',
    'user',
    'views',
    'charts',
    'block',
    'system',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    $this->legacyView();
  }

  /**
   * Tests the hook_update_8229() function.
   */
  public function testHookUpdate8229(): void {

    visitors_update_8229();

    $view = $this->config('views.view.visitors');
    $view_data = $view->getRawData();
    $this->assertEquals($this->getCurrentView(), $view_data);
  }

  /**
   * Create a legacy view.
   */
  protected function legacyView(): void {
    $yaml = <<<YAML
langcode: en
status: true
dependencies:
  module:
    - charts
    - charts_chartjs
    - visitors
id: visitors
label: Visitors
module: views
description: 'Visitors web analytics reports.'
tag: ''
base_table: visitors
base_field: ''
display:
  default:
    id: default
    display_title: Default
    display_plugin: default
    position: 0
    display_options:
      title: ''
      fields:
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: mini
        options:
          offset: 0
          items_per_page: 10
          total_pages: null
          id: 0
          tags:
            next: ››
            previous: ‹‹
          expose:
            items_per_page: false
            items_per_page_label: 'Items per page'
            items_per_page_options: '5, 10, 25, 50'
            items_per_page_options_all: false
            items_per_page_options_all_label: '- All -'
            offset: false
            offset_label: Offset
      exposed_form:
        type: basic
        options:
          submit_button: Apply
          reset_button: false
          reset_button_label: Reset
          exposed_sorts_label: 'Sort by'
          expose_sort_order: true
          sort_asc_label: Asc
          sort_desc_label: Desc
      access:
        type: none
        options: {  }
      cache:
        type: none
        options: {  }
      empty: {  }
      sorts:
        visitors_id:
          id: visitors_id
          table: visitors
          field: visitors_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          order: DESC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      arguments: {  }
      filters:
        bot:
          id: bot
          table: visitors
          field: bot
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: boolean
          operator: '!='
          value: '1'
          group: 1
          exposed: false
          expose:
            operator_id: ''
            label: ''
            description: ''
            use_operator: false
            operator: ''
            operator_limit_selection: false
            operator_list: {  }
            identifier: ''
            required: false
            remember: false
            multiple: false
            remember_roles:
              authenticated: authenticated
          is_grouped: false
          group_info:
            label: ''
            description: ''
            identifier: ''
            optional: true
            widget: select
            multiple: false
            remember: false
            default_group: All
            default_group_multiple: {  }
            group_items: {  }
        visitors_date_time:
          id: visitors_date_time
          table: visitors
          field: visitors_date_time
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_date
          operator: between
          value:
            min: to
            max: from
            value: ''
            type: global
          group: 1
          exposed: false
          expose:
            operator_id: ''
            label: ''
            description: ''
            use_operator: false
            operator: ''
            operator_limit_selection: false
            operator_list: {  }
            identifier: ''
            required: false
            remember: false
            multiple: false
            remember_roles:
              authenticated: authenticated
            min_placeholder: ''
            max_placeholder: ''
            placeholder: ''
          is_grouped: false
          group_info:
            label: ''
            description: ''
            identifier: ''
            optional: true
            widget: select
            multiple: false
            remember: false
            default_group: All
            default_group_multiple: {  }
            group_items: {  }
      style:
        type: table
        options:
          grouping: {  }
          row_class: ''
          default_row_class: true
          columns:
            route: route
            visitor_id: visitor_id
          default: visitor_id
          info:
            route:
              sortable: false
              default_sort_order: asc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
            visitor_id:
              sortable: true
              default_sort_order: desc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
          override: true
          sticky: true
          summary: ''
          empty_table: false
          caption: ''
          description: ''
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      query:
        type: views_query
        options:
          query_comment: ''
          disable_sql_rewrite: false
          distinct: false
          replica: false
          query_tags: {  }
      relationships: {  }
      use_ajax: true
      group_by: true
      header: {  }
      footer: {  }
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
      tags: {  }
  browser_engine_pie:
    id: browser_engine_pie
    display_title: 'Engine Pie'
    display_plugin: embed
    position: 8
    display_options:
      title: 'Browser Engines'
      fields:
        config_browser_engine:
          id: config_browser_engine
          table: visitors
          field: config_browser_engine
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: Engine
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      style:
        type: chart
        options:
          grouping: {  }
          chart_settings:
            library: chartjs
            type: pie
            fields:
              label: config_browser_engine
              stacking: false
              data_providers:
                config_browser_engine:
                  enabled: false
                  color: '#000000'
                  weight: 2
                visitor_id:
                  enabled: true
                  color: '#000000'
                  weight: 2
            display:
              title: 'Browser Engines'
              title_position: top
              subtitle: ''
              data_labels: false
              data_markers: true
              legend_position: bottom
              background: ''
              three_dimensional: 0
              polar: 0
              tooltips: true
              dimensions:
                width: '60'
                width_units: ''
                height: '60'
                height_units: '%'
              gauge:
                max: ''
                min: ''
                green_from: ''
                green_to: ''
                yellow_from: ''
                yellow_to: ''
                red_from: ''
                red_to: ''
              color_changer: false
            xaxis:
              title: ''
              labels_rotation: '0'
            yaxis:
              title: ''
              min: ''
              max: ''
              prefix: ''
              suffix: ''
              decimal_count: ''
              labels_rotation: '0'
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        title: false
        style: false
        row: false
        fields: false
        footer: false
      display_description: ''
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: table
          empty: false
          display_id: browser_engine_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
      tags: {  }
  browser_engine_table:
    id: browser_engine_table
    display_title: 'Engine Table'
    display_plugin: embed
    position: 8
    display_options:
      title: 'Browser Engines'
      fields:
        config_browser_engine:
          id: config_browser_engine
          table: visitors
          field: config_browser_engine
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: Engine
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
        footer: false
      display_description: ''
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: chart
          empty: false
          display_id: browser_engine_pie
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
      tags: {  }
  browser_name_table:
    id: browser_name_table
    display_title: 'Browser Name'
    display_plugin: embed
    position: 6
    display_options:
      title: Browser
      fields:
        config_browser_name:
          id: config_browser_name
          table: visitors
          field: config_browser_name
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_browser
          label: Browser
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
        footer: false
      display_description: ''
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: 'Browser version'
          empty: false
          display_id: browser_version_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
      tags: {  }
  browser_version_table:
    id: browser_version_table
    display_title: 'Browser Version'
    display_plugin: embed
    position: 7
    display_options:
      title: 'Browser Version'
      fields:
        config_browser_name:
          id: config_browser_name
          table: visitors
          field: config_browser_name
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_browser
          label: 'Browser Name'
          exclude: true
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: true
        config_browser_version:
          id: config_browser_version
          table: visitors
          field: config_browser_version
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: 'Browser Version'
          exclude: false
          alter:
            alter_text: true
            text: '{{ config_browser_name }} {{ config_browser_version }} '
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
        footer: false
      display_description: ''
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: Browser
          empty: false
          display_id: browser_name_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
      tags: {  }
  continent_pie:
    id: continent_pie
    display_title: 'Continent Pie'
    display_plugin: embed
    position: 1
    display_options:
      title: Continent
      fields:
        location_continent:
          id: location_continent
          table: visitors
          field: location_continent
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_continent
          label: Continent
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      style:
        type: chart
        options:
          grouping: {  }
          chart_settings:
            library: chartjs
            type: pie
            fields:
              label: location_continent
              stacking: false
              data_providers:
                location_continent:
                  enabled: false
                  color: '#000000'
                  weight: 2
                visitor_id:
                  enabled: true
                  color: '#000000'
                  weight: 2
            display:
              title: Continent
              title_position: top
              subtitle: ''
              data_labels: false
              data_markers: true
              legend_position: bottom
              background: ''
              three_dimensional: 0
              polar: 0
              tooltips: true
              dimensions:
                width: '60'
                width_units: '%'
                height: '60'
                height_units: '%'
              gauge:
                max: ''
                min: ''
                green_from: ''
                green_to: ''
                yellow_from: ''
                yellow_to: ''
                red_from: ''
                red_to: ''
              color_changer: false
            xaxis:
              title: ''
              labels_rotation: '0'
            yaxis:
              title: ''
              min: ''
              max: ''
              prefix: ''
              suffix: ''
              decimal_count: ''
              labels_rotation: '0'
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        title: false
        style: false
        row: false
        fields: false
        footer: false
      display_description: ''
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: table
          empty: false
          display_id: continent_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
      tags: {  }
  continent_table:
    id: continent_table
    display_title: 'Continent Table'
    display_plugin: embed
    position: 1
    display_options:
      title: Continent
      fields:
        location_continent_1:
          id: location_continent_1
          table: visitors
          field: location_continent
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_continent
          label: Abbreviation
          exclude: true
          alter:
            alter_text: true
            text: '{{ location_continent_1|lower }}'
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          abbreviation: true
        location_continent:
          id: location_continent
          table: visitors
          field: location_continent
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_continent
          label: Continent
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: true
            path: 'internal:/visitors/location/continent/{{ location_continent_1 }}'
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          abbreviation: false
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
        footer: false
      display_description: ''
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: chart
          empty: false
          display_id: continent_pie
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
      tags: {  }
  country_table:
    id: country_table
    display_title: Country
    display_plugin: embed
    position: 2
    display_options:
      title: Country
      fields:
        location_country_1:
          id: location_country_1
          table: visitors
          field: location_country
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_country
          label: Abbreviation
          exclude: true
          alter:
            alter_text: true
            text: '{{ location_country_1|lower }}'
            make_link: false
            path: 'internal:/visitors/location/region/{{ location_country_1 }}'
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: true
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: false
          text: false
          abbreviation: true
        location_country:
          id: location_country
          table: visitors
          field: location_country
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_country
          label: Country
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: true
            path: 'internal:/visitors/location/country/{{location_country_1}}'
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: true
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: true
          text: true
          abbreviation: false
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      arguments:
        location_continent:
          id: location_continent
          table: visitors
          field: location_continent
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: string
          default_action: ignore
          exception:
            value: all
            title_enable: false
            title: All
          title_enable: false
          title: ''
          default_argument_type: fixed
          default_argument_options:
            argument: ''
          summary_options:
            base_path: ''
            count: true
            override: false
            items_per_page: 25
          summary:
            sort_order: asc
            number_of_records: 0
            format: default_summary
          specify_validation: false
          validate:
            type: none
            fail: 'not found'
          validate_options: {  }
          glossary: false
          limit: 0
          case: none
          path_case: none
          transform_dash: false
          break_phrase: false
      defaults:
        title: false
        fields: false
        arguments: false
        filters: true
        filter_groups: true
      display_description: ''
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url
        - url.query_args
      tags: {  }
  daily_column:
    id: daily_column
    display_title: 'Daily Column'
    display_plugin: embed
    position: 26
    display_options:
      fields:
        visitors_day:
          id: visitors_day
          table: visitors
          field: visitors_day
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_day
          label: Day
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_day:
          id: visitors_day
          table: visitors
          field: visitors_day
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: chart
        options:
          grouping: {  }
          chart_settings:
            library: chartjs
            type: column
            fields:
              label: visitors_day
              stacking: false
              data_providers:
                visitors_day:
                  enabled: false
                  color: '#006fb0'
                  weight: 2
                visitor_id:
                  enabled: true
                  color: '#0277bd'
                  weight: 2
            display:
              title: Daily
              title_position: top
              subtitle: ''
              data_labels: false
              data_markers: true
              legend_position: ''
              background: ''
              three_dimensional: 0
              polar: 0
              tooltips: true
              dimensions:
                width: ''
                width_units: ''
                height: ''
                height_units: ''
              gauge:
                max: ''
                min: ''
                green_from: ''
                green_to: ''
                yellow_from: ''
                yellow_to: ''
                red_from: ''
                red_to: ''
              color_changer: false
            xaxis:
              title: ''
              labels_rotation: '0'
            yaxis:
              title: ''
              min: ''
              max: ''
              prefix: ''
              suffix: ''
              decimal_count: ''
              labels_rotation: '0'
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer: {  }
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
      tags: {  }
  day_of_month_column:
    id: day_of_month_column
    display_title: 'Day of Month Column'
    display_plugin: embed
    position: 28
    display_options:
      fields:
        visitors_day_of_month:
          id: visitors_day_of_month
          table: visitors
          field: visitors_day_of_month
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_day_of_month
          label: 'Day of Month'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_day_of_month:
          id: visitors_day_of_month
          table: visitors
          field: visitors_day_of_month
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: chart
        options:
          grouping: {  }
          chart_settings:
            library: chartjs
            type: column
            fields:
              label: visitors_day_of_month
              stacking: false
              data_providers:
                visitors_day_of_month:
                  enabled: false
                  color: '#000000'
                  weight: 2
                visitor_id:
                  enabled: true
                  color: '#0277bd'
                  weight: 2
            display:
              title: 'Day of Month'
              title_position: top
              subtitle: ''
              data_labels: false
              data_markers: true
              legend_position: ''
              background: ''
              three_dimensional: 0
              polar: 0
              tooltips: true
              dimensions:
                width: ''
                width_units: ''
                height: ''
                height_units: ''
              gauge:
                max: ''
                min: ''
                green_from: ''
                green_to: ''
                yellow_from: ''
                yellow_to: ''
                red_from: ''
                red_to: ''
              color_changer: false
            xaxis:
              title: ''
              labels_rotation: '0'
            yaxis:
              title: ''
              min: ''
              max: ''
              prefix: ''
              suffix: ''
              decimal_count: ''
              labels_rotation: '0'
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: table
          empty: false
          display_id: day_of_month_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
      tags: {  }
  day_of_month_table:
    id: day_of_month_table
    display_title: 'Day of Month Table'
    display_plugin: embed
    position: 28
    display_options:
      title: 'Day of Month'
      fields:
        visitors_day_of_month:
          id: visitors_day_of_month
          table: visitors
          field: visitors_day_of_month
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_day_of_month
          label: 'Day of Month'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_day_of_month:
          id: visitors_day_of_month
          table: visitors
          field: visitors_day_of_month
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: table
        options:
          grouping: {  }
          row_class: ''
          default_row_class: true
          columns:
            visitors_day_of_month: visitors_day_of_month
            visitor_id: visitor_id
          default: '-1'
          info:
            visitors_day_of_month:
              sortable: false
              default_sort_order: asc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
            visitor_id:
              sortable: true
              default_sort_order: desc
              align: views-align-right
              separator: ''
              empty_column: false
              responsive: ''
          override: true
          sticky: true
          summary: ''
          empty_table: false
          caption: 'Day of Month'
          description: ''
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        title: false
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: chart
          empty: false
          display_id: day_of_month_column
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
      tags: {  }
  day_of_week_column:
    id: day_of_week_column
    display_title: 'Day of Week Column'
    display_plugin: embed
    position: 30
    display_options:
      fields:
        visitors_day_of_week:
          id: visitors_day_of_week
          table: visitors
          field: visitors_day_of_week
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_day_of_week
          label: 'Day of Week'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_day_of_week:
          id: visitors_day_of_week
          table: visitors
          field: visitors_day_of_week
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: chart
        options:
          grouping: {  }
          chart_settings:
            library: chartjs
            type: column
            fields:
              label: visitors_day_of_week
              stacking: false
              data_providers:
                visitors_day_of_week:
                  enabled: false
                  color: '#000000'
                  weight: 2
                visitor_id:
                  enabled: true
                  color: '#0277bd'
                  weight: 2
            display:
              title: 'Day of Week'
              title_position: top
              subtitle: ''
              data_labels: false
              data_markers: true
              legend_position: ''
              background: ''
              three_dimensional: 0
              polar: 0
              tooltips: true
              dimensions:
                width: ''
                width_units: ''
                height: ''
                height_units: ''
              gauge:
                max: ''
                min: ''
                green_from: ''
                green_to: ''
                yellow_from: ''
                yellow_to: ''
                red_from: ''
                red_to: ''
              color_changer: false
            xaxis:
              title: ''
              labels_rotation: '0'
            yaxis:
              title: ''
              min: ''
              max: ''
              prefix: ''
              suffix: ''
              decimal_count: ''
              labels_rotation: '0'
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: table
          empty: false
          display_id: day_of_week_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
      tags: {  }
  day_of_week_table:
    id: day_of_week_table
    display_title: 'Day of Week Table'
    display_plugin: embed
    position: 30
    display_options:
      title: 'Day of Week'
      fields:
        visitors_day_of_week:
          id: visitors_day_of_week
          table: visitors
          field: visitors_day_of_week
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_day_of_week
          label: 'Day of Week'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_day_of_week:
          id: visitors_day_of_week
          table: visitors
          field: visitors_day_of_week
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: table
        options:
          grouping: {  }
          row_class: ''
          default_row_class: true
          columns:
            visitors_day_of_week: visitors_day_of_week
            visitor_id: visitor_id
          default: '-1'
          info:
            visitors_day_of_week:
              sortable: false
              default_sort_order: asc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
            visitor_id:
              sortable: true
              default_sort_order: desc
              align: views-align-right
              separator: ''
              empty_column: false
              responsive: ''
          override: true
          sticky: true
          summary: ''
          empty_table: false
          caption: 'Day of Week'
          description: ''
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        title: false
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: chart
          empty: false
          display_id: day_of_week_column
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
      tags: {  }
  device_brand_table:
    id: device_brand_table
    display_title: 'Device Brand'
    display_plugin: embed
    position: 10
    display_options:
      title: 'Device Brand'
      fields:
        config_device_brand:
          id: config_device_brand
          table: visitors
          field: config_device_brand
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_brand
          label: Brand
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
      display_description: ''
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
      tags: {  }
  device_config_table:
    id: device_config_table
    display_title: Configuration
    display_plugin: embed
    position: 13
    display_options:
      title: Configuration
      fields:
        config_os:
          id: config_os
          table: visitors
          field: config_os
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_operating_system
          label: 'Operating System'
          exclude: true
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: false
        config_browser_name:
          id: config_browser_name
          table: visitors
          field: config_browser_name
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_browser
          label: 'Browser Name'
          exclude: true
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: false
        config_resolution:
          id: config_resolution
          table: visitors
          field: config_resolution
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: Configurations
          exclude: false
          alter:
            alter_text: true
            text: '{{ config_os }} / {{ config_browser_name }} / {{ config_resolution }} '
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
        footer: false
      display_description: ''
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: Resolution
          empty: false
          display_id: device_resolution_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
      tags: {  }
  device_model_table:
    id: device_model_table
    display_title: 'Device Model'
    display_plugin: embed
    position: 11
    display_options:
      title: Model
      fields:
        config_device_brand:
          id: config_device_brand
          table: visitors
          field: config_device_brand
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_brand
          label: 'Device brand'
          exclude: true
          alter:
            alter_text: true
            text: '{{ config_device_brand }} - '
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: false
        config_device_model:
          id: config_device_model
          table: visitors
          field: config_device_model
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: 'Device model'
          exclude: true
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: Generic
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        config_device_type:
          id: config_device_type
          table: visitors
          field: config_device_type
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_device
          label: 'Device model'
          exclude: false
          alter:
            alter_text: true
            text: '{{ config_device_brand }}{{ config_device_model }} {{ config_device_type }} '
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: false
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
      display_description: ''
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
      tags: {  }
  device_resolution_table:
    id: device_resolution_table
    display_title: Resolution
    display_plugin: embed
    position: 12
    display_options:
      title: Resolution
      fields:
        config_resolution:
          id: config_resolution
          table: visitors
          field: config_resolution
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: Resolution
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
        footer: false
      display_description: ''
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: Configurations
          empty: false
          display_id: device_config_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
      tags: {  }
  device_type_table:
    id: device_type_table
    display_title: 'Device Type'
    display_plugin: embed
    position: 9
    display_options:
      title: 'Device Type'
      fields:
        config_device_type:
          id: config_device_type
          table: visitors
          field: config_device_type
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_device
          label: Device
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
      display_description: ''
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
      tags: {  }
  distinct_countries_list:
    id: distinct_countries_list
    display_title: 'Distinct Countries'
    display_plugin: embed
    position: 3
    display_options:
      title: 'Distinct Countries'
      fields:
        location_country:
          id: location_country
          table: visitors
          field: location_country
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: visitors_country
          label: ''
          exclude: false
          alter:
            alter_text: false
            text: '{{ location_country }} distinct countries'
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: false
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: false
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: true
          format_plural_string: !!binary MSBkaXN0aW5jdCBjb3VudHJ5A0Bjb3VudCBkaXN0aW5jdCBjb3VudHJpZXM=
          prefix: ''
          suffix: ''
      sorts: {  }
      style:
        type: default
        options:
          grouping: {  }
          row_class: ''
          default_row_class: true
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        title: false
        style: false
        row: false
        fields: false
        sorts: false
        filters: true
        filter_groups: true
      display_description: ''
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
      tags: {  }
  hour_column:
    id: hour_column
    display_title: 'Hour Column'
    display_plugin: embed
    position: 24
    display_options:
      fields:
        visitors_hour:
          id: visitors_hour
          table: visitors
          field: visitors_hour
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_hour
          label: Hour
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_hour:
          id: visitors_hour
          table: visitors
          field: visitors_hour
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: chart
        options:
          grouping: {  }
          chart_settings:
            library: chartjs
            type: column
            fields:
              label: visitors_hour
              stacking: false
              data_providers:
                visitors_hour:
                  enabled: false
                  color: '#000000'
                  weight: 2
                visitor_id:
                  enabled: true
                  color: '#0277bd'
                  weight: 2
            display:
              title: 'Your time'
              title_position: top
              subtitle: ''
              data_labels: false
              data_markers: false
              legend_position: ''
              background: ''
              three_dimensional: 0
              polar: 0
              tooltips: true
              dimensions:
                width: ''
                width_units: ''
                height: ''
                height_units: ''
              gauge:
                max: ''
                min: ''
                green_from: ''
                green_to: ''
                yellow_from: ''
                yellow_to: ''
                red_from: ''
                red_to: ''
              color_changer: false
            xaxis:
              title: ''
              labels_rotation: '0'
            yaxis:
              title: ''
              min: ''
              max: ''
              prefix: ''
              suffix: ''
              decimal_count: ''
              labels_rotation: '0'
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: table
          empty: false
          display_id: hour_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
      tags: {  }
  hour_table:
    id: hour_table
    display_title: 'Hour Table'
    display_plugin: embed
    position: 24
    display_options:
      title: 'Your time'
      fields:
        visitors_hour:
          id: visitors_hour
          table: visitors
          field: visitors_hour
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_hour
          label: Hour
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_hour:
          id: visitors_hour
          table: visitors
          field: visitors_hour
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: table
        options:
          grouping: {  }
          row_class: ''
          default_row_class: true
          columns:
            visitors_hour: visitors_hour
            visitor_id: visitor_id
          default: '-1'
          info:
            visitors_hour:
              sortable: false
              default_sort_order: asc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
            visitor_id:
              sortable: true
              default_sort_order: desc
              align: views-align-right
              separator: ''
              empty_column: false
              responsive: ''
          override: true
          sticky: true
          summary: ''
          empty_table: false
          caption: 'Your time'
          description: ''
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        title: false
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: chart
          empty: false
          display_id: hour_column
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
      tags: {  }
  language_code_table:
    id: language_code_table
    display_title: 'Language Code'
    display_plugin: embed
    position: 5
    display_options:
      title: 'Language Code'
      fields:
        language:
          id: language
          table: visitors
          field: language
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_language
          label: Language
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          code: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
        filters: true
        filter_groups: true
        footer: false
      display_description: ''
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: Language
          empty: false
          display_id: language_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
      tags: {  }
  language_table:
    id: language_table
    display_title: Language
    display_plugin: embed
    position: 4
    display_options:
      title: Language
      fields:
        language:
          id: language
          table: visitors
          field: language
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: Language
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
        filters: true
        filter_groups: true
        footer: false
      display_description: ''
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: 'Language Code'
          empty: false
          display_id: language_code_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
      tags: {  }
  local_hour_column:
    id: local_hour_column
    display_title: 'Local Column'
    display_plugin: embed
    position: 22
    display_options:
      fields:
        visitor_localtime:
          id: visitor_localtime
          table: visitors
          field: visitor_localtime
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_local_hour
          label: Hour
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitor_localtime:
          id: visitor_localtime
          table: visitors
          field: visitor_localtime
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: chart
        options:
          grouping: {  }
          chart_settings:
            library: chartjs
            type: column
            fields:
              label: visitor_localtime
              stacking: false
              data_providers:
                visitor_localtime:
                  enabled: false
                  color: '#000000'
                  weight: 2
                visitor_id:
                  enabled: true
                  color: '#0277bd'
                  weight: 2
            display:
              title: "Visitor's time"
              title_position: ''
              subtitle: ''
              data_labels: false
              data_markers: true
              legend_position: ''
              background: ''
              three_dimensional: 0
              polar: 0
              tooltips: true
              dimensions:
                width: ''
                width_units: ''
                height: ''
                height_units: ''
              gauge:
                max: ''
                min: ''
                green_from: ''
                green_to: ''
                yellow_from: ''
                yellow_to: ''
                red_from: ''
                red_to: ''
              color_changer: false
            xaxis:
              title: ''
              labels_rotation: '0'
            yaxis:
              title: ''
              min: ''
              max: ''
              prefix: ''
              suffix: ''
              decimal_count: '0'
              labels_rotation: '0'
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: table
          empty: false
          display_id: local_hour_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
      tags: {  }
  local_hour_table:
    id: local_hour_table
    display_title: 'Local Table'
    display_plugin: embed
    position: 22
    display_options:
      title: "Visitor's time"
      fields:
        visitor_localtime:
          id: visitor_localtime
          table: visitors
          field: visitor_localtime
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_local_hour
          label: Hour
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitor_localtime:
          id: visitor_localtime
          table: visitors
          field: visitor_localtime
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: table
        options:
          grouping: {  }
          row_class: ''
          default_row_class: true
          columns:
            visitor_localtime: visitor_localtime
            visitor_id: visitor_id
          default: '-1'
          info:
            visitor_localtime:
              sortable: false
              default_sort_order: asc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
            visitor_id:
              sortable: true
              default_sort_order: desc
              align: views-align-right
              separator: ''
              empty_column: false
              responsive: ''
          override: true
          sticky: true
          summary: ''
          empty_table: false
          caption: "Visitor's time"
          description: ''
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        title: false
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: chart
          empty: false
          display_id: local_hour_column
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
      tags: {  }
  monthly_column:
    id: monthly_column
    display_title: 'Monthly Column'
    display_plugin: embed
    position: 26
    display_options:
      fields:
        visitors_month:
          id: visitors_month
          table: visitors
          field: visitors_month
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_month
          label: Month
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_month:
          id: visitors_month
          table: visitors
          field: visitors_month
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: chart
        options:
          grouping: {  }
          chart_settings:
            library: chartjs
            type: column
            fields:
              label: visitors_month
              stacking: false
              data_providers:
                visitors_month:
                  enabled: false
                  color: '#000000'
                  weight: 2
                visitor_id:
                  enabled: true
                  color: '#0277bd'
                  weight: 2
            display:
              title: Monthly
              title_position: top
              subtitle: ''
              data_labels: false
              data_markers: true
              legend_position: ''
              background: ''
              three_dimensional: 0
              polar: 0
              tooltips: true
              dimensions:
                width: ''
                width_units: ''
                height: ''
                height_units: ''
              gauge:
                max: ''
                min: ''
                green_from: ''
                green_to: ''
                yellow_from: ''
                yellow_to: ''
                red_from: ''
                red_to: ''
              color_changer: false
            xaxis:
              title: ''
              labels_rotation: '0'
            yaxis:
              title: ''
              min: ''
              max: ''
              prefix: ''
              suffix: ''
              decimal_count: ''
              labels_rotation: '0'
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: table
          empty: false
          display_id: monthly_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
      tags: {  }
  monthly_table:
    id: monthly_table
    display_title: 'Monthly Table'
    display_plugin: embed
    position: 26
    display_options:
      title: Monthly
      fields:
        visitors_month:
          id: visitors_month
          table: visitors
          field: visitors_month
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_month
          label: Month
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_month:
          id: visitors_month
          table: visitors
          field: visitors_month
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: table
        options:
          grouping: {  }
          row_class: ''
          default_row_class: true
          columns:
            visitors_month: visitors_month
            visitor_id: visitor_id
          default: '-1'
          info:
            visitors_month:
              sortable: false
              default_sort_order: asc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
            visitor_id:
              sortable: true
              default_sort_order: desc
              align: views-align-right
              separator: ''
              empty_column: false
              responsive: ''
          override: true
          sticky: true
          summary: ''
          empty_table: false
          caption: Monthly
          description: ''
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        title: false
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: chart
          empty: false
          display_id: monthly_column
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
      tags: {  }
  os_family_table:
    id: os_family_table
    display_title: 'OS Family'
    display_plugin: embed
    position: 14
    display_options:
      title: 'OS Family'
      fields:
        config_os:
          id: config_os
          table: visitors
          field: config_os
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_operating_system
          label: 'Operating System families'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
        footer: false
      display_description: ''
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: 'Operating System versions'
          empty: false
          display_id: os_version_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
      tags: {  }
  os_version_table:
    id: os_version_table
    display_title: 'OS Version'
    display_plugin: embed
    position: 15
    display_options:
      title: 'OS Version'
      fields:
        config_os_version:
          id: config_os_version
          table: visitors
          field: config_os_version
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: 'OS version'
          exclude: true
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: Unknown
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        config_os:
          id: config_os
          table: visitors
          field: config_os
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_operating_system
          label: 'Operating System'
          exclude: false
          alter:
            alter_text: true
            text: '{{ config_os }}  {{ config_os_version }}'
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
        footer: false
      display_description: ''
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: 'Operating System families'
          empty: false
          display_id: os_family_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
      tags: {  }
  performance_daily_column:
    id: performance_daily_column
    display_title: 'Performance Daily'
    display_plugin: embed
    position: 21
    display_options:
      fields:
        pf_network:
          id: pf_network
          table: visitors
          field: pf_network
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: Network
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_server:
          id: pf_server
          table: visitors
          field: pf_server
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: Server
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_transfer:
          id: pf_transfer
          table: visitors
          field: pf_transfer
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: Transfer
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_dom_processing:
          id: pf_dom_processing
          table: visitors
          field: pf_dom_processing
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: 'DOM Processing'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_dom_complete:
          id: pf_dom_complete
          table: visitors
          field: pf_dom_complete
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: 'DOM Complete'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_on_load:
          id: pf_on_load
          table: visitors
          field: pf_on_load
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: 'On Load'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        visitors_day:
          id: visitors_day
          table: visitors
          field: visitors_day
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_day
          label: Day
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_day:
          id: visitors_day
          table: visitors
          field: visitors_day
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: chart
        options:
          grouping: {  }
          chart_settings:
            library: chartjs
            type: column
            fields:
              label: visitors_day
              stacking: true
              data_providers:
                pf_network:
                  enabled: true
                  color: '#0277bd'
                  weight: 7
                pf_server:
                  enabled: true
                  color: '#ff8f00'
                  weight: 7
                pf_transfer:
                  enabled: true
                  color: '#ad1457'
                  weight: 7
                pf_dom_processing:
                  enabled: true
                  color: '#6a1b9a'
                  weight: 7
                pf_dom_complete:
                  enabled: true
                  color: '#558b2f'
                  weight: 7
                pf_on_load:
                  enabled: true
                  color: '#00838f'
                  weight: 7
                visitors_day:
                  enabled: false
                  color: '#7643b6'
                  weight: 7
            display:
              title: ''
              title_position: ''
              subtitle: ''
              data_labels: false
              data_markers: true
              legend_position: bottom
              background: ''
              three_dimensional: 0
              polar: 0
              tooltips: true
              dimensions:
                width: ''
                width_units: ''
                height: ''
                height_units: ''
              gauge:
                max: ''
                min: ''
                green_from: ''
                green_to: ''
                yellow_from: ''
                yellow_to: ''
                red_from: ''
                red_to: ''
              color_changer: false
            xaxis:
              title: ''
              labels_rotation: '0'
            yaxis:
              title: ''
              min: ''
              max: ''
              prefix: ''
              suffix: ''
              decimal_count: ''
              labels_rotation: '0'
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        pager: false
        style: false
        row: false
        relationships: false
        fields: false
        sorts: false
      relationships: {  }
      display_description: ''
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
      tags: {  }
  performance_hourly_column:
    id: performance_hourly_column
    display_title: 'Performance Hourly'
    display_plugin: embed
    position: 21
    display_options:
      fields:
        pf_network:
          id: pf_network
          table: visitors
          field: pf_network
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: Network
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_server:
          id: pf_server
          table: visitors
          field: pf_server
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: Server
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_transfer:
          id: pf_transfer
          table: visitors
          field: pf_transfer
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: Transfer
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_dom_processing:
          id: pf_dom_processing
          table: visitors
          field: pf_dom_processing
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: 'DOM Processing'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_dom_complete:
          id: pf_dom_complete
          table: visitors
          field: pf_dom_complete
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: 'DOM Complete'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_on_load:
          id: pf_on_load
          table: visitors
          field: pf_on_load
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: 'On Load'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        visitors_hour:
          id: visitors_hour
          table: visitors
          field: visitors_hour
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_hour
          label: Hour
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_hour:
          id: visitors_hour
          table: visitors
          field: visitors_hour
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: chart
        options:
          grouping: {  }
          chart_settings:
            library: chartjs
            type: column
            fields:
              label: visitors_hour
              stacking: true
              data_providers:
                pf_network:
                  enabled: true
                  color: '#0277bd'
                  weight: 7
                pf_server:
                  enabled: true
                  color: '#ff8f00'
                  weight: 7
                pf_transfer:
                  enabled: true
                  color: '#ad1457'
                  weight: 7
                pf_dom_processing:
                  enabled: true
                  color: '#6a1b9a'
                  weight: 7
                pf_dom_complete:
                  enabled: true
                  color: '#558b2f'
                  weight: 7
                pf_on_load:
                  enabled: true
                  color: '#00838f'
                  weight: 7
                visitors_hour:
                  enabled: false
                  color: '#7643b6'
                  weight: 7
            display:
              title: ''
              title_position: ''
              subtitle: ''
              data_labels: false
              data_markers: true
              legend_position: bottom
              background: ''
              three_dimensional: 0
              polar: 0
              tooltips: true
              dimensions:
                width: ''
                width_units: ''
                height: ''
                height_units: ''
              gauge:
                max: ''
                min: ''
                green_from: ''
                green_to: ''
                yellow_from: ''
                yellow_to: ''
                red_from: ''
                red_to: ''
              color_changer: false
            xaxis:
              title: ''
              labels_rotation: '0'
            yaxis:
              title: ''
              min: ''
              max: ''
              prefix: ''
              suffix: ''
              decimal_count: ''
              labels_rotation: '0'
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        pager: false
        style: false
        row: false
        relationships: false
        fields: false
        sorts: false
      relationships: {  }
      display_description: ''
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
      tags: {  }
  performance_weekly_column:
    id: performance_weekly_column
    display_title: 'Performance Weekly'
    display_plugin: embed
    position: 21
    display_options:
      fields:
        pf_network:
          id: pf_network
          table: visitors
          field: pf_network
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: Network
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_server:
          id: pf_server
          table: visitors
          field: pf_server
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: Server
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_transfer:
          id: pf_transfer
          table: visitors
          field: pf_transfer
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: Transfer
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_dom_processing:
          id: pf_dom_processing
          table: visitors
          field: pf_dom_processing
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: 'DOM Processing'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_dom_complete:
          id: pf_dom_complete
          table: visitors
          field: pf_dom_complete
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: 'DOM Complete'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_on_load:
          id: pf_on_load
          table: visitors
          field: pf_on_load
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: 'On Load'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        visitors_week:
          id: visitors_week
          table: visitors
          field: visitors_week
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_week
          label: Week
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_week:
          id: visitors_week
          table: visitors
          field: visitors_week
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: chart
        options:
          grouping: {  }
          chart_settings:
            library: chartjs
            type: column
            fields:
              label: visitors_week
              stacking: true
              data_providers:
                pf_network:
                  enabled: true
                  color: '#0277bd'
                  weight: 7
                pf_server:
                  enabled: true
                  color: '#ff8f00'
                  weight: 7
                pf_transfer:
                  enabled: true
                  color: '#ad1457'
                  weight: 7
                pf_dom_processing:
                  enabled: true
                  color: '#6a1b9a'
                  weight: 7
                pf_dom_complete:
                  enabled: true
                  color: '#558b2f'
                  weight: 7
                pf_on_load:
                  enabled: true
                  color: '#00838f'
                  weight: 7
                visitors_week:
                  enabled: false
                  color: '#7643b6'
                  weight: 7
            display:
              title: ''
              title_position: ''
              subtitle: ''
              data_labels: false
              data_markers: true
              legend_position: bottom
              background: ''
              three_dimensional: 0
              polar: 0
              tooltips: true
              dimensions:
                width: ''
                width_units: ''
                height: ''
                height_units: ''
              gauge:
                max: ''
                min: ''
                green_from: ''
                green_to: ''
                yellow_from: ''
                yellow_to: ''
                red_from: ''
                red_to: ''
              color_changer: false
            xaxis:
              title: ''
              labels_rotation: '0'
            yaxis:
              title: ''
              min: ''
              max: ''
              prefix: ''
              suffix: ''
              decimal_count: ''
              labels_rotation: '0'
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        pager: false
        style: false
        row: false
        relationships: false
        fields: false
        sorts: false
      relationships: {  }
      display_description: ''
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
      tags: {  }
  recent_view_table:
    id: recent_view_table
    display_title: 'Recent views'
    display_plugin: embed
    position: 19
    display_options:
      fields:
        visitors_id:
          id: visitors_id
          table: visitors
          field: visitors_id
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: numeric
          label: 'Visitors ID'
          exclude: true
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        visitors_url:
          id: visitors_url
          table: visitors
          field: visitors_url
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: URL
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitors_date_time:
          id: visitors_date_time
          table: visitors
          field: visitors_date_time
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: date
          label: 'Date Time'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          date_format: short
          custom_date_format: ''
          timezone: ''
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: Visitor
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        nothing:
          id: nothing
          table: views
          field: nothing
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: custom
          label: Operations
          exclude: false
          alter:
            alter_text: true
            text: details
            make_link: true
            path: 'internal:/visitors/hits/{{ visitors_id }}'
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: false
      pager:
        type: full
        options:
          offset: 0
          items_per_page: 10
          total_pages: null
          id: 0
          tags:
            next: ››
            previous: ‹‹
            first: '« First'
            last: 'Last »'
          expose:
            items_per_page: false
            items_per_page_label: 'Items per page'
            items_per_page_options: '5, 10, 25, 50'
            items_per_page_options_all: false
            items_per_page_options_all_label: '- All -'
            offset: false
            offset_label: Offset
          quantity: 9
      sorts: {  }
      arguments:
        route:
          id: route
          table: visitors
          field: route
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: string
          default_action: ignore
          exception:
            value: all
            title_enable: false
            title: All
          title_enable: false
          title: ''
          default_argument_type: fixed
          default_argument_options:
            argument: ''
          summary_options:
            base_path: ''
            count: true
            override: false
            items_per_page: 25
          summary:
            sort_order: asc
            number_of_records: 0
            format: default_summary
          specify_validation: false
          validate:
            type: none
            fail: 'not found'
          validate_options: {  }
          glossary: false
          limit: 0
          case: none
          path_case: none
          transform_dash: false
          break_phrase: false
        visitors_ip:
          id: visitors_ip
          table: visitors
          field: visitors_ip
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: string
          default_action: ignore
          exception:
            value: all
            title_enable: false
            title: All
          title_enable: false
          title: ''
          default_argument_type: fixed
          default_argument_options:
            argument: ''
          summary_options:
            base_path: ''
            count: true
            override: false
            items_per_page: 25
          summary:
            sort_order: asc
            number_of_records: 0
            format: default_summary
          specify_validation: false
          validate:
            type: none
            fail: 'not found'
          validate_options: {  }
          glossary: false
          limit: 0
          case: none
          path_case: none
          transform_dash: false
          break_phrase: false
        location_country:
          id: location_country
          table: visitors
          field: location_country
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: string
          default_action: ignore
          exception:
            value: all
            title_enable: false
            title: All
          title_enable: false
          title: ''
          default_argument_type: fixed
          default_argument_options:
            argument: ''
          summary_options:
            base_path: ''
            count: true
            override: false
            items_per_page: 25
          summary:
            sort_order: asc
            number_of_records: 0
            format: default_summary
          specify_validation: false
          validate:
            type: none
            fail: 'not found'
          validate_options: {  }
          glossary: false
          limit: 0
          case: upper
          path_case: none
          transform_dash: false
          break_phrase: false
      filters:
        bot:
          id: bot
          table: visitors
          field: bot
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: boolean
          operator: '!='
          value: '1'
          group: 1
          exposed: false
          expose:
            operator_id: ''
            label: ''
            description: ''
            use_operator: false
            operator: ''
            operator_limit_selection: false
            operator_list: {  }
            identifier: ''
            required: false
            remember: false
            multiple: false
            remember_roles:
              authenticated: authenticated
          is_grouped: false
          group_info:
            label: ''
            description: ''
            identifier: ''
            optional: true
            widget: select
            multiple: false
            remember: false
            default_group: All
            default_group_multiple: {  }
            group_items: {  }
        visitors_date_time:
          id: visitors_date_time
          table: visitors
          field: visitors_date_time
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_date
          operator: between
          value:
            min: to
            max: from
            value: ''
            type: global
          group: 1
          exposed: false
          expose:
            operator_id: ''
            label: ''
            description: ''
            use_operator: false
            operator: ''
            operator_limit_selection: false
            operator_list: {  }
            identifier: ''
            required: false
            remember: false
            multiple: false
            remember_roles:
              authenticated: authenticated
            min_placeholder: ''
            max_placeholder: ''
            placeholder: ''
          is_grouped: false
          group_info:
            label: ''
            description: ''
            identifier: ''
            optional: true
            widget: select
            multiple: false
            remember: false
            default_group: All
            default_group_multiple: {  }
            group_items: {  }
        visitors_path:
          id: visitors_path
          table: visitors
          field: visitors_path
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: string
          operator: starts
          value: ''
          group: 1
          exposed: true
          expose:
            operator_id: visitors_path_op
            label: Path
            description: ''
            use_operator: false
            operator: visitors_path_op
            operator_limit_selection: false
            operator_list: {  }
            identifier: visitors_path
            required: false
            remember: false
            multiple: false
            remember_roles:
              authenticated: authenticated
              anonymous: '0'
              content_editor: '0'
              administrator: '0'
            placeholder: ''
          is_grouped: false
          group_info:
            label: ''
            description: ''
            identifier: ''
            optional: true
            widget: select
            multiple: false
            remember: false
            default_group: All
            default_group_multiple: {  }
            group_items: {  }
      filter_groups:
        operator: AND
        groups:
          1: AND
      style:
        type: table
        options:
          grouping: {  }
          row_class: ''
          default_row_class: true
          columns:
            visitors_id: visitors_id
            visitors_url: visitors_url
            visitors_date_time: visitors_date_time
            visitor_id: visitor_id
            nothing: nothing
          default: visitors_date_time
          info:
            visitors_id:
              sortable: false
              default_sort_order: asc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
            visitors_url:
              sortable: false
              default_sort_order: asc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
            visitors_date_time:
              sortable: true
              default_sort_order: desc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
            visitor_id:
              sortable: false
              default_sort_order: desc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
            nothing:
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
          override: true
          sticky: true
          summary: ''
          empty_table: false
          caption: ''
          description: ''
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        pager: false
        group_by: false
        style: false
        row: false
        relationships: false
        fields: false
        sorts: false
        arguments: false
        filters: false
        filter_groups: false
        header: false
      relationships: {  }
      group_by: false
      display_description: ''
      header:
        result:
          id: result
          table: views
          field: result
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: result
          empty: false
          content: 'Displaying @start - @end of @total'
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url
        - url.query_args
      tags: {  }
  referrer_table:
    id: referrer_table
    display_title: 'Referrer views'
    display_plugin: embed
    position: 19
    display_options:
      fields:
        visitors_id:
          id: visitors_id
          table: visitors
          field: visitors_id
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: numeric
          label: 'Visitors ID'
          exclude: true
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        visitors_referer:
          id: visitors_referer
          table: visitors
          field: visitors_referer
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: Referrer
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: '(Direct Entry)'
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitors_date_time:
          id: visitors_date_time
          table: visitors
          field: visitors_date_time
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: date
          label: 'Date Time'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          date_format: fallback
          custom_date_format: ''
          timezone: ''
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: Visitor
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        nothing:
          id: nothing
          table: views
          field: nothing
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: custom
          label: Operations
          exclude: false
          alter:
            alter_text: true
            text: details
            make_link: true
            path: 'internal:/visitors/hits/{{ visitors_id }}'
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: false
      pager:
        type: full
        options:
          offset: 0
          items_per_page: 10
          total_pages: null
          id: 0
          tags:
            next: ››
            previous: ‹‹
            first: '« First'
            last: 'Last »'
          expose:
            items_per_page: false
            items_per_page_label: 'Items per page'
            items_per_page_options: '5, 10, 25, 50'
            items_per_page_options_all: false
            items_per_page_options_all_label: '- All -'
            offset: false
            offset_label: Offset
          quantity: 9
      sorts:
        visitors_id:
          id: visitors_id
          table: visitors
          field: visitors_id
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          order: DESC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      arguments:
        visitors_path:
          id: visitors_path
          table: visitors
          field: visitors_path
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: string
          default_action: default
          exception:
            value: all
            title_enable: false
            title: All
          title_enable: false
          title: ''
          default_argument_type: visitors_path
          default_argument_options:
            pop: 1
            route: false
          summary_options:
            base_path: ''
            count: true
            override: false
            items_per_page: 25
          summary:
            sort_order: asc
            number_of_records: 0
            format: default_summary
          specify_validation: false
          validate:
            type: none
            fail: 'not found'
          validate_options: {  }
          glossary: false
          limit: 0
          case: none
          path_case: none
          transform_dash: false
          break_phrase: false
      defaults:
        pager: false
        group_by: false
        relationships: false
        fields: false
        sorts: false
        arguments: false
        header: false
      relationships: {  }
      group_by: false
      display_description: ''
      header:
        result:
          id: result
          table: views
          field: result
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: result
          empty: false
          content: 'Displaying @start - @end of @total'
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url
        - url.path
        - url.query_args
      tags: {  }
  top_host_table:
    id: top_host_table
    display_title: 'Top Host'
    display_plugin: embed
    position: 18
    display_options:
      fields:
        visitors_ip:
          id: visitors_ip
          table: visitors
          field: visitors_ip
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: Host
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: true
            path: 'internal:/visitors/host/{{ visitors_ip }}'
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        fields: false
        header: false
      display_description: ''
      header:
        result:
          id: result
          table: views
          field: result
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: result
          empty: false
          content: 'Displaying @start - @end of @total'
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
      tags: {  }
  top_path_table:
    id: top_path_table
    display_title: 'Top Path'
    display_plugin: embed
    position: 16
    display_options:
      title: Path
      fields:
        visitors_path:
          id: visitors_path
          table: visitors
          field: visitors_path
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: Path
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      sorts: {  }
      defaults:
        title: false
        fields: false
        sorts: false
        header: false
      display_description: ''
      header:
        result:
          id: result
          table: views
          field: result
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: result
          empty: false
          content: 'Displaying @start - @end of @total'
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
      tags: {  }
  top_route_table:
    id: top_route_table
    display_title: 'Top Route'
    display_plugin: embed
    position: 17
    display_options:
      fields:
        route:
          id: route
          table: visitors
          field: route
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: Route
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: true
            path: 'internal:/visitors/route/{{ route }}'
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      sorts: {  }
      filters:
        bot:
          id: bot
          table: visitors
          field: bot
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: boolean
          operator: '!='
          value: '1'
          group: 1
          exposed: false
          expose:
            operator_id: ''
            label: ''
            description: ''
            use_operator: false
            operator: ''
            operator_limit_selection: false
            operator_list: {  }
            identifier: ''
            required: false
            remember: false
            multiple: false
            remember_roles:
              authenticated: authenticated
          is_grouped: false
          group_info:
            label: ''
            description: ''
            identifier: ''
            optional: true
            widget: select
            multiple: false
            remember: false
            default_group: All
            default_group_multiple: {  }
            group_items: {  }
        visitors_date_time:
          id: visitors_date_time
          table: visitors
          field: visitors_date_time
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_date
          operator: between
          value:
            min: to
            max: from
            value: ''
            type: global
          group: 1
          exposed: false
          expose:
            operator_id: ''
            label: ''
            description: ''
            use_operator: false
            operator: ''
            operator_limit_selection: false
            operator_list: {  }
            identifier: ''
            required: false
            remember: false
            multiple: false
            remember_roles:
              authenticated: authenticated
            min_placeholder: ''
            max_placeholder: ''
            placeholder: ''
          is_grouped: false
          group_info:
            label: ''
            description: ''
            identifier: ''
            optional: true
            widget: select
            multiple: false
            remember: false
            default_group: All
            default_group_multiple: {  }
            group_items: {  }
        route:
          id: route
          table: visitors
          field: route
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: string
          operator: starts
          value: ''
          group: 1
          exposed: true
          expose:
            operator_id: route_op
            label: Route
            description: ''
            use_operator: false
            operator: route_op
            operator_limit_selection: false
            operator_list: {  }
            identifier: route
            required: false
            remember: false
            multiple: false
            remember_roles:
              authenticated: authenticated
              anonymous: '0'
              content_editor: '0'
              administrator: '0'
            placeholder: ''
          is_grouped: false
          group_info:
            label: ''
            description: ''
            identifier: ''
            optional: true
            widget: select
            multiple: false
            remember: false
            default_group: All
            default_group_multiple: {  }
            group_items: {  }
      filter_groups:
        operator: AND
        groups:
          1: AND
      style:
        type: table
        options:
          grouping: {  }
          row_class: ''
          default_row_class: true
          columns:
            route: route
            visitor_id: visitor_id
          default: visitor_id
          info:
            route:
              sortable: false
              default_sort_order: asc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
            visitor_id:
              sortable: true
              default_sort_order: desc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
          override: true
          sticky: true
          summary: ''
          empty_table: false
          caption: ''
          description: ''
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        style: false
        row: false
        fields: false
        sorts: false
        filters: false
        filter_groups: false
        header: false
      display_description: ''
      header:
        result:
          id: result
          table: views
          field: result
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: result
          empty: false
          content: 'Displaying @start - @end of @total'
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url
        - url.query_args
      tags: {  }
  weekly_column:
    id: weekly_column
    display_title: 'Weekly Column'
    display_plugin: embed
    position: 26
    display_options:
      fields:
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitors_week:
          id: visitors_week
          table: visitors
          field: visitors_week
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_week
          label: Week
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_week:
          id: visitors_week
          table: visitors
          field: visitors_week
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: chart
        options:
          grouping: {  }
          chart_settings:
            library: chartjs
            type: column
            fields:
              label: visitors_week
              stacking: false
              data_providers:
                visitor_id:
                  enabled: true
                  color: '#0277bd'
                  weight: -1
                visitors_week:
                  enabled: false
                  color: '#0277bd'
                  weight: -2
            display:
              title: Weekly
              title_position: top
              subtitle: ''
              data_labels: false
              data_markers: true
              legend_position: ''
              background: ''
              three_dimensional: 0
              polar: 0
              tooltips: true
              dimensions:
                width: ''
                width_units: ''
                height: ''
                height_units: ''
              gauge:
                max: ''
                min: ''
                green_from: ''
                green_to: ''
                yellow_from: ''
                yellow_to: ''
                red_from: ''
                red_to: ''
              color_changer: false
            xaxis:
              title: ''
              labels_rotation: '0'
            yaxis:
              title: ''
              min: ''
              max: ''
              prefix: ''
              suffix: ''
              decimal_count: ''
              labels_rotation: '0'
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer: {  }
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
      tags: {  }
  weekly_table:
    id: weekly_table
    display_title: 'Weekly Table'
    display_plugin: embed
    position: 26
    display_options:
      fields:
        visitors_week:
          id: visitors_week
          table: visitors
          field: visitors_week
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_week
          label: Week
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_week:
          id: visitors_week
          table: visitors
          field: visitors_week
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: table
        options:
          grouping: {  }
          row_class: ''
          default_row_class: true
          columns:
            visitor_id: visitor_id
            visitors_week: visitors_week
          default: '-1'
          info:
            visitor_id:
              sortable: false
              default_sort_order: asc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
            visitors_week:
              sortable: false
              default_sort_order: asc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
          override: true
          sticky: false
          summary: ''
          empty_table: false
          caption: ''
          description: ''
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer: {  }
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
      tags: {  }

YAML;

    $views_array = Yaml::parse($yaml);
    $view = $this->config('views.view.visitors');
    $view->setData($views_array);
    $view->save();
  }

  /**
   * Get the current view.
   */
  protected function getCurrentView(): array {
    $yaml = <<<YAML
langcode: en
status: true
dependencies:
  module:
    - charts
    - charts_chartjs
    - visitors
id: visitors
label: Visitors
module: views
description: 'Visitors web analytics reports.'
tag: ''
base_table: visitors
base_field: ''
display:
  default:
    id: default
    display_title: Default
    display_plugin: default
    position: 0
    display_options:
      title: ''
      fields:
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: mini
        options:
          offset: 0
          items_per_page: 10
          total_pages: null
          id: 0
          tags:
            next: ››
            previous: ‹‹
          expose:
            items_per_page: false
            items_per_page_label: 'Items per page'
            items_per_page_options: '5, 10, 25, 50'
            items_per_page_options_all: false
            items_per_page_options_all_label: '- All -'
            offset: false
            offset_label: Offset
      exposed_form:
        type: basic
        options:
          submit_button: Apply
          reset_button: false
          reset_button_label: Reset
          exposed_sorts_label: 'Sort by'
          expose_sort_order: true
          sort_asc_label: Asc
          sort_desc_label: Desc
      access:
        type: none
        options: {  }
      cache:
        type: tag
        options: {  }
      empty: {  }
      sorts:
        visitors_id:
          id: visitors_id
          table: visitors
          field: visitors_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          order: DESC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      arguments: {  }
      filters:
        bot:
          id: bot
          table: visitors
          field: bot
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: boolean
          operator: '!='
          value: '1'
          group: 1
          exposed: false
          expose:
            operator_id: ''
            label: ''
            description: ''
            use_operator: false
            operator: ''
            operator_limit_selection: false
            operator_list: {  }
            identifier: ''
            required: false
            remember: false
            multiple: false
            remember_roles:
              authenticated: authenticated
          is_grouped: false
          group_info:
            label: ''
            description: ''
            identifier: ''
            optional: true
            widget: select
            multiple: false
            remember: false
            default_group: All
            default_group_multiple: {  }
            group_items: {  }
        visitors_date_time:
          id: visitors_date_time
          table: visitors
          field: visitors_date_time
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_date
          operator: between
          value:
            min: to
            max: from
            value: ''
            type: global
          group: 1
          exposed: false
          expose:
            operator_id: ''
            label: ''
            description: ''
            use_operator: false
            operator: ''
            operator_limit_selection: false
            operator_list: {  }
            identifier: ''
            required: false
            remember: false
            multiple: false
            remember_roles:
              authenticated: authenticated
            min_placeholder: ''
            max_placeholder: ''
            placeholder: ''
          is_grouped: false
          group_info:
            label: ''
            description: ''
            identifier: ''
            optional: true
            widget: select
            multiple: false
            remember: false
            default_group: All
            default_group_multiple: {  }
            group_items: {  }
      style:
        type: table
        options:
          grouping: {  }
          row_class: ''
          default_row_class: true
          columns:
            route: route
            visitor_id: visitor_id
          default: visitor_id
          info:
            route:
              sortable: false
              default_sort_order: asc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
            visitor_id:
              sortable: true
              default_sort_order: desc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
          override: true
          sticky: true
          summary: ''
          empty_table: false
          caption: ''
          description: ''
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      query:
        type: views_query
        options:
          query_comment: ''
          disable_sql_rewrite: false
          distinct: false
          replica: false
          query_tags: {  }
      relationships: {  }
      use_ajax: true
      group_by: true
      header: {  }
      footer: {  }
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
        - visitors_date_range
      tags: {  }
  browser_engine_pie:
    id: browser_engine_pie
    display_title: 'Engine Pie'
    display_plugin: embed
    position: 8
    display_options:
      title: 'Browser Engines'
      fields:
        config_browser_engine:
          id: config_browser_engine
          table: visitors
          field: config_browser_engine
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: Engine
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      style:
        type: chart
        options:
          grouping: {  }
          chart_settings:
            library: chartjs
            type: pie
            fields:
              label: config_browser_engine
              stacking: false
              data_providers:
                config_browser_engine:
                  enabled: false
                  color: '#000000'
                  weight: 2
                visitor_id:
                  enabled: true
                  color: '#000000'
                  weight: 2
            display:
              title: 'Browser Engines'
              title_position: top
              subtitle: ''
              data_labels: false
              data_markers: true
              legend_position: bottom
              background: ''
              three_dimensional: 0
              polar: 0
              tooltips: true
              dimensions:
                width: '60'
                width_units: ''
                height: '60'
                height_units: '%'
              gauge:
                max: ''
                min: ''
                green_from: ''
                green_to: ''
                yellow_from: ''
                yellow_to: ''
                red_from: ''
                red_to: ''
              color_changer: false
            xaxis:
              title: ''
              labels_rotation: '0'
            yaxis:
              title: ''
              min: ''
              max: ''
              prefix: ''
              suffix: ''
              decimal_count: ''
              labels_rotation: '0'
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        title: false
        style: false
        row: false
        fields: false
        footer: false
      display_description: ''
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: table
          empty: false
          display_id: browser_engine_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
        - visitors_date_range
      tags: {  }
  browser_engine_table:
    id: browser_engine_table
    display_title: 'Engine Table'
    display_plugin: embed
    position: 8
    display_options:
      title: 'Browser Engines'
      fields:
        config_browser_engine:
          id: config_browser_engine
          table: visitors
          field: config_browser_engine
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: Engine
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
        footer: false
      display_description: ''
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: chart
          empty: false
          display_id: browser_engine_pie
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
        - visitors_date_range
      tags: {  }
  browser_name_table:
    id: browser_name_table
    display_title: 'Browser Name'
    display_plugin: embed
    position: 6
    display_options:
      title: Browser
      fields:
        config_browser_name:
          id: config_browser_name
          table: visitors
          field: config_browser_name
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_browser
          label: Browser
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
        footer: false
      display_description: ''
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: 'Browser version'
          empty: false
          display_id: browser_version_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
        - visitors_date_range
      tags: {  }
  browser_plugin_list:
    id: browser_plugin_list
    display_title: 'Browser Plugins'
    display_plugin: embed
    position: 39
    display_options:
      title: 'Browser Plugins'
      fields:
        config_cookie:
          id: config_cookie
          table: visitors
          field: config_cookie
          relationship: none
          group_type: sum
          admin_label: ''
          plugin_id: visitors_cookie
          label: Cookie
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: .visitors-cookie-plugin-icon
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: true
          empty_zero: true
          hide_alter_empty: true
          icon: false
        config_pdf:
          id: config_pdf
          table: visitors
          field: config_pdf
          relationship: none
          group_type: sum
          admin_label: ''
          plugin_id: visitors_pdf
          label: PDF
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: .visitors-pdf-plugin-icon
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: true
          empty_zero: true
          hide_alter_empty: true
          icon: false
        config_flash:
          id: config_flash
          table: visitors
          field: config_flash
          relationship: none
          group_type: sum
          admin_label: ''
          plugin_id: visitors_flash
          label: Flash
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: .visitors-flash-plugin-icon
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: true
          empty_zero: true
          hide_alter_empty: true
          icon: false
        config_java:
          id: config_java
          table: visitors
          field: config_java
          relationship: none
          group_type: sum
          admin_label: ''
          plugin_id: visitors_java
          label: Java
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: .visitors-java-plugin-icon
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: true
          empty_zero: true
          hide_alter_empty: true
          icon: false
        config_silverlight:
          id: config_silverlight
          table: visitors
          field: config_silverlight
          relationship: none
          group_type: sum
          admin_label: ''
          plugin_id: visitors_silverlight
          label: Silverlight
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: .visitors-silverlight-plugin-icon
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: true
          empty_zero: true
          hide_alter_empty: true
          icon: false
        config_windowsmedia:
          id: config_windowsmedia
          table: visitors
          field: config_windowsmedia
          relationship: none
          group_type: sum
          admin_label: ''
          plugin_id: visitors_windowsmedia
          label: 'Windows Media'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: .visitors-windows-media-plugin-icon
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: true
          empty_zero: true
          hide_alter_empty: true
          icon: false
        config_quicktime:
          id: config_quicktime
          table: visitors
          field: config_quicktime
          relationship: none
          group_type: sum
          admin_label: ''
          plugin_id: visitors_quicktime
          label: Quicktime
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: .visitors-quicktime-plugin-icon
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: true
          empty_zero: true
          hide_alter_empty: true
          icon: false
        config_realplayer:
          id: config_realplayer
          table: visitors
          field: config_realplayer
          relationship: none
          group_type: sum
          admin_label: ''
          plugin_id: visitors_realplayer
          label: Realplayer
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: .visitors-realplayer-plugin-icon
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: true
          empty_zero: true
          hide_alter_empty: true
          icon: false
      pager:
        type: none
        options:
          offset: 0
      sorts: {  }
      style:
        type: default
        options:
          grouping: {  }
          row_class: ''
          default_row_class: true
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        title: false
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer:
        area_text_custom:
          id: area_text_custom
          table: views
          field: area_text_custom
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: text_custom
          empty: false
          content: 'Note: Plugin detection does not work in Internet Explorer before 11. This report is only based on non-IE browsers and newer versions of IE.'
          tokenize: false
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - visitors_date_range
      tags: {  }
  browser_version_table:
    id: browser_version_table
    display_title: 'Browser Version'
    display_plugin: embed
    position: 7
    display_options:
      title: 'Browser Version'
      fields:
        config_browser_name:
          id: config_browser_name
          table: visitors
          field: config_browser_name
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_browser
          label: 'Browser Name'
          exclude: true
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: true
        config_browser_version:
          id: config_browser_version
          table: visitors
          field: config_browser_version
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: 'Browser Version'
          exclude: false
          alter:
            alter_text: true
            text: '{{ config_browser_name }} {{ config_browser_version }} '
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
        footer: false
      display_description: ''
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: Browser
          empty: false
          display_id: browser_name_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
        - visitors_date_range
      tags: {  }
  continent_pie:
    id: continent_pie
    display_title: 'Continent Pie'
    display_plugin: embed
    position: 1
    display_options:
      title: Continent
      fields:
        location_continent:
          id: location_continent
          table: visitors
          field: location_continent
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_continent
          label: Continent
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      style:
        type: chart
        options:
          grouping: {  }
          chart_settings:
            library: chartjs
            type: pie
            fields:
              label: location_continent
              stacking: false
              data_providers:
                location_continent:
                  enabled: false
                  color: '#000000'
                  weight: 2
                visitor_id:
                  enabled: true
                  color: '#000000'
                  weight: 2
            display:
              title: Continent
              title_position: top
              subtitle: ''
              data_labels: false
              data_markers: true
              legend_position: bottom
              background: ''
              three_dimensional: 0
              polar: 0
              tooltips: true
              dimensions:
                width: '60'
                width_units: '%'
                height: '60'
                height_units: '%'
              gauge:
                max: ''
                min: ''
                green_from: ''
                green_to: ''
                yellow_from: ''
                yellow_to: ''
                red_from: ''
                red_to: ''
              color_changer: false
            xaxis:
              title: ''
              labels_rotation: '0'
            yaxis:
              title: ''
              min: ''
              max: ''
              prefix: ''
              suffix: ''
              decimal_count: ''
              labels_rotation: '0'
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        title: false
        style: false
        row: false
        fields: false
        footer: false
      display_description: ''
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: table
          empty: false
          display_id: continent_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
        - visitors_date_range
      tags: {  }
  continent_table:
    id: continent_table
    display_title: 'Continent Table'
    display_plugin: embed
    position: 1
    display_options:
      title: Continent
      fields:
        location_continent_1:
          id: location_continent_1
          table: visitors
          field: location_continent
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_continent
          label: Abbreviation
          exclude: true
          alter:
            alter_text: true
            text: '{{ location_continent_1|lower }}'
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          abbreviation: true
        location_continent:
          id: location_continent
          table: visitors
          field: location_continent
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_continent
          label: Continent
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: true
            path: 'internal:/visitors/location/continent/{{ location_continent_1 }}'
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          abbreviation: false
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
        footer: false
      display_description: ''
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: chart
          empty: false
          display_id: continent_pie
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
        - visitors_date_range
      tags: {  }
  country_table:
    id: country_table
    display_title: Country
    display_plugin: embed
    position: 2
    display_options:
      title: Country
      fields:
        location_country_1:
          id: location_country_1
          table: visitors
          field: location_country
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_country
          label: Abbreviation
          exclude: true
          alter:
            alter_text: true
            text: '{{ location_country_1|lower }}'
            make_link: false
            path: 'internal:/visitors/location/region/{{ location_country_1 }}'
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: true
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: false
          text: false
          abbreviation: true
        location_country:
          id: location_country
          table: visitors
          field: location_country
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_country
          label: Country
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: true
            path: 'internal:/visitors/location/country/{{location_country_1}}'
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: true
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: true
          text: true
          abbreviation: false
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      arguments:
        location_continent:
          id: location_continent
          table: visitors
          field: location_continent
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: string
          default_action: ignore
          exception:
            value: all
            title_enable: false
            title: All
          title_enable: false
          title: ''
          default_argument_type: fixed
          default_argument_options:
            argument: ''
          summary_options:
            base_path: ''
            count: true
            override: false
            items_per_page: 25
          summary:
            sort_order: asc
            number_of_records: 0
            format: default_summary
          specify_validation: false
          validate:
            type: none
            fail: 'not found'
          validate_options: {  }
          glossary: false
          limit: 0
          case: none
          path_case: none
          transform_dash: false
          break_phrase: false
      defaults:
        title: false
        fields: false
        arguments: false
        filters: true
        filter_groups: true
      display_description: ''
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url
        - url.query_args
        - visitors_date_range
      tags: {  }
  daily_column:
    id: daily_column
    display_title: 'Daily Column'
    display_plugin: embed
    position: 26
    display_options:
      fields:
        visitors_day:
          id: visitors_day
          table: visitors
          field: visitors_day
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_day
          label: Day
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_day:
          id: visitors_day
          table: visitors
          field: visitors_day
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: chart
        options:
          grouping: {  }
          chart_settings:
            library: chartjs
            type: column
            fields:
              label: visitors_day
              stacking: false
              data_providers:
                visitors_day:
                  enabled: false
                  color: '#006fb0'
                  weight: 2
                visitor_id:
                  enabled: true
                  color: '#0277bd'
                  weight: 2
            display:
              title: Daily
              title_position: top
              subtitle: ''
              data_labels: false
              data_markers: true
              legend_position: ''
              background: ''
              three_dimensional: 0
              polar: 0
              tooltips: true
              dimensions:
                width: ''
                width_units: ''
                height: ''
                height_units: ''
              gauge:
                max: ''
                min: ''
                green_from: ''
                green_to: ''
                yellow_from: ''
                yellow_to: ''
                red_from: ''
                red_to: ''
              color_changer: false
            xaxis:
              title: ''
              labels_rotation: '0'
            yaxis:
              title: ''
              min: ''
              max: ''
              prefix: ''
              suffix: ''
              decimal_count: ''
              labels_rotation: '0'
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer: {  }
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - visitors_date_range
      tags: {  }
  day_of_month_column:
    id: day_of_month_column
    display_title: 'Day of Month Column'
    display_plugin: embed
    position: 28
    display_options:
      fields:
        visitors_day_of_month:
          id: visitors_day_of_month
          table: visitors
          field: visitors_day_of_month
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_day_of_month
          label: 'Day of Month'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_day_of_month:
          id: visitors_day_of_month
          table: visitors
          field: visitors_day_of_month
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: chart
        options:
          grouping: {  }
          chart_settings:
            library: chartjs
            type: column
            fields:
              label: visitors_day_of_month
              stacking: false
              data_providers:
                visitors_day_of_month:
                  enabled: false
                  color: '#000000'
                  weight: 2
                visitor_id:
                  enabled: true
                  color: '#0277bd'
                  weight: 2
            display:
              title: 'Day of Month'
              title_position: top
              subtitle: ''
              data_labels: false
              data_markers: true
              legend_position: ''
              background: ''
              three_dimensional: 0
              polar: 0
              tooltips: true
              dimensions:
                width: ''
                width_units: ''
                height: ''
                height_units: ''
              gauge:
                max: ''
                min: ''
                green_from: ''
                green_to: ''
                yellow_from: ''
                yellow_to: ''
                red_from: ''
                red_to: ''
              color_changer: false
            xaxis:
              title: ''
              labels_rotation: '0'
            yaxis:
              title: ''
              min: ''
              max: ''
              prefix: ''
              suffix: ''
              decimal_count: ''
              labels_rotation: '0'
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: table
          empty: false
          display_id: day_of_month_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - visitors_date_range
      tags: {  }
  day_of_month_table:
    id: day_of_month_table
    display_title: 'Day of Month Table'
    display_plugin: embed
    position: 28
    display_options:
      title: 'Day of Month'
      fields:
        visitors_day_of_month:
          id: visitors_day_of_month
          table: visitors
          field: visitors_day_of_month
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_day_of_month
          label: 'Day of Month'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_day_of_month:
          id: visitors_day_of_month
          table: visitors
          field: visitors_day_of_month
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: table
        options:
          grouping: {  }
          row_class: ''
          default_row_class: true
          columns:
            visitors_day_of_month: visitors_day_of_month
            visitor_id: visitor_id
          default: '-1'
          info:
            visitors_day_of_month:
              sortable: false
              default_sort_order: asc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
            visitor_id:
              sortable: true
              default_sort_order: desc
              align: views-align-right
              separator: ''
              empty_column: false
              responsive: ''
          override: true
          sticky: true
          summary: ''
          empty_table: false
          caption: 'Day of Month'
          description: ''
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        title: false
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: chart
          empty: false
          display_id: day_of_month_column
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
        - visitors_date_range
      tags: {  }
  day_of_week_column:
    id: day_of_week_column
    display_title: 'Day of Week Column'
    display_plugin: embed
    position: 30
    display_options:
      fields:
        visitors_day_of_week:
          id: visitors_day_of_week
          table: visitors
          field: visitors_day_of_week
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_day_of_week
          label: 'Day of Week'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_day_of_week:
          id: visitors_day_of_week
          table: visitors
          field: visitors_day_of_week
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: chart
        options:
          grouping: {  }
          chart_settings:
            library: chartjs
            type: column
            fields:
              label: visitors_day_of_week
              stacking: false
              data_providers:
                visitors_day_of_week:
                  enabled: false
                  color: '#000000'
                  weight: 2
                visitor_id:
                  enabled: true
                  color: '#0277bd'
                  weight: 2
            display:
              title: 'Day of Week'
              title_position: top
              subtitle: ''
              data_labels: false
              data_markers: true
              legend_position: ''
              background: ''
              three_dimensional: 0
              polar: 0
              tooltips: true
              dimensions:
                width: ''
                width_units: ''
                height: ''
                height_units: ''
              gauge:
                max: ''
                min: ''
                green_from: ''
                green_to: ''
                yellow_from: ''
                yellow_to: ''
                red_from: ''
                red_to: ''
              color_changer: false
            xaxis:
              title: ''
              labels_rotation: '0'
            yaxis:
              title: ''
              min: ''
              max: ''
              prefix: ''
              suffix: ''
              decimal_count: ''
              labels_rotation: '0'
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: table
          empty: false
          display_id: day_of_week_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - visitors_date_range
      tags: {  }
  day_of_week_table:
    id: day_of_week_table
    display_title: 'Day of Week Table'
    display_plugin: embed
    position: 30
    display_options:
      title: 'Day of Week'
      fields:
        visitors_day_of_week:
          id: visitors_day_of_week
          table: visitors
          field: visitors_day_of_week
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_day_of_week
          label: 'Day of Week'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_day_of_week:
          id: visitors_day_of_week
          table: visitors
          field: visitors_day_of_week
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: table
        options:
          grouping: {  }
          row_class: ''
          default_row_class: true
          columns:
            visitors_day_of_week: visitors_day_of_week
            visitor_id: visitor_id
          default: '-1'
          info:
            visitors_day_of_week:
              sortable: false
              default_sort_order: asc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
            visitor_id:
              sortable: true
              default_sort_order: desc
              align: views-align-right
              separator: ''
              empty_column: false
              responsive: ''
          override: true
          sticky: true
          summary: ''
          empty_table: false
          caption: 'Day of Week'
          description: ''
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        title: false
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: chart
          empty: false
          display_id: day_of_week_column
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
        - visitors_date_range
      tags: {  }
  device_brand_table:
    id: device_brand_table
    display_title: 'Device Brand'
    display_plugin: embed
    position: 10
    display_options:
      title: 'Device Brand'
      fields:
        config_device_brand:
          id: config_device_brand
          table: visitors
          field: config_device_brand
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_brand
          label: Brand
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
      display_description: ''
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
        - visitors_date_range
      tags: {  }
  device_config_table:
    id: device_config_table
    display_title: Configuration
    display_plugin: embed
    position: 13
    display_options:
      title: Configuration
      fields:
        config_os:
          id: config_os
          table: visitors
          field: config_os
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_operating_system
          label: 'Operating System'
          exclude: true
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: false
        config_browser_name:
          id: config_browser_name
          table: visitors
          field: config_browser_name
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_browser
          label: 'Browser Name'
          exclude: true
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: false
        config_resolution:
          id: config_resolution
          table: visitors
          field: config_resolution
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: Configurations
          exclude: false
          alter:
            alter_text: true
            text: '{{ config_os }} / {{ config_browser_name }} / {{ config_resolution }} '
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
        footer: false
      display_description: ''
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: Resolution
          empty: false
          display_id: device_resolution_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
        - visitors_date_range
      tags: {  }
  device_model_table:
    id: device_model_table
    display_title: 'Device Model'
    display_plugin: embed
    position: 11
    display_options:
      title: Model
      fields:
        config_device_brand:
          id: config_device_brand
          table: visitors
          field: config_device_brand
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_brand
          label: 'Device brand'
          exclude: true
          alter:
            alter_text: true
            text: '{{ config_device_brand }} - '
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: false
        config_device_model:
          id: config_device_model
          table: visitors
          field: config_device_model
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: 'Device model'
          exclude: true
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: Generic
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        config_device_type:
          id: config_device_type
          table: visitors
          field: config_device_type
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_device
          label: 'Device model'
          exclude: false
          alter:
            alter_text: true
            text: '{{ config_device_brand }}{{ config_device_model }} {{ config_device_type }} '
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: false
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
      display_description: ''
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
        - visitors_date_range
      tags: {  }
  device_resolution_table:
    id: device_resolution_table
    display_title: Resolution
    display_plugin: embed
    position: 12
    display_options:
      title: Resolution
      fields:
        config_resolution:
          id: config_resolution
          table: visitors
          field: config_resolution
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: Resolution
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
        footer: false
      display_description: ''
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: Configurations
          empty: false
          display_id: device_config_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
        - visitors_date_range
      tags: {  }
  device_type_table:
    id: device_type_table
    display_title: 'Device Type'
    display_plugin: embed
    position: 9
    display_options:
      title: 'Device Type'
      fields:
        config_device_type:
          id: config_device_type
          table: visitors
          field: config_device_type
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_device
          label: Device
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
      display_description: ''
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
        - visitors_date_range
      tags: {  }
  distinct_countries_list:
    id: distinct_countries_list
    display_title: 'Distinct Countries'
    display_plugin: embed
    position: 3
    display_options:
      title: 'Distinct Countries'
      fields:
        location_country:
          id: location_country
          table: visitors
          field: location_country
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: visitors_country
          label: ''
          exclude: false
          alter:
            alter_text: false
            text: '{{ location_country }} distinct countries'
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: false
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: false
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: true
          format_plural_string: !!binary MSBkaXN0aW5jdCBjb3VudHJ5A0Bjb3VudCBkaXN0aW5jdCBjb3VudHJpZXM=
          prefix: ''
          suffix: ''
      sorts: {  }
      style:
        type: default
        options:
          grouping: {  }
          row_class: ''
          default_row_class: true
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        title: false
        style: false
        row: false
        fields: false
        sorts: false
        filters: true
        filter_groups: true
      display_description: ''
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
        - visitors_date_range
      tags: {  }
  hour_column:
    id: hour_column
    display_title: 'Hour Column'
    display_plugin: embed
    position: 24
    display_options:
      fields:
        visitors_hour:
          id: visitors_hour
          table: visitors
          field: visitors_hour
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_hour
          label: Hour
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_hour:
          id: visitors_hour
          table: visitors
          field: visitors_hour
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: chart
        options:
          grouping: {  }
          chart_settings:
            library: chartjs
            type: column
            fields:
              label: visitors_hour
              stacking: false
              data_providers:
                visitors_hour:
                  enabled: false
                  color: '#000000'
                  weight: 2
                visitor_id:
                  enabled: true
                  color: '#0277bd'
                  weight: 2
            display:
              title: 'Your time'
              title_position: top
              subtitle: ''
              data_labels: false
              data_markers: false
              legend_position: ''
              background: ''
              three_dimensional: 0
              polar: 0
              tooltips: true
              dimensions:
                width: ''
                width_units: ''
                height: ''
                height_units: ''
              gauge:
                max: ''
                min: ''
                green_from: ''
                green_to: ''
                yellow_from: ''
                yellow_to: ''
                red_from: ''
                red_to: ''
              color_changer: false
            xaxis:
              title: ''
              labels_rotation: '0'
            yaxis:
              title: ''
              min: ''
              max: ''
              prefix: ''
              suffix: ''
              decimal_count: ''
              labels_rotation: '0'
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: table
          empty: false
          display_id: hour_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - visitors_date_range
      tags: {  }
  hour_table:
    id: hour_table
    display_title: 'Hour Table'
    display_plugin: embed
    position: 24
    display_options:
      title: 'Your time'
      fields:
        visitors_hour:
          id: visitors_hour
          table: visitors
          field: visitors_hour
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_hour
          label: Hour
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_hour:
          id: visitors_hour
          table: visitors
          field: visitors_hour
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: table
        options:
          grouping: {  }
          row_class: ''
          default_row_class: true
          columns:
            visitors_hour: visitors_hour
            visitor_id: visitor_id
          default: '-1'
          info:
            visitors_hour:
              sortable: false
              default_sort_order: asc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
            visitor_id:
              sortable: true
              default_sort_order: desc
              align: views-align-right
              separator: ''
              empty_column: false
              responsive: ''
          override: true
          sticky: true
          summary: ''
          empty_table: false
          caption: 'Your time'
          description: ''
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        title: false
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: chart
          empty: false
          display_id: hour_column
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
        - visitors_date_range
      tags: {  }
  language_code_table:
    id: language_code_table
    display_title: 'Language Code'
    display_plugin: embed
    position: 5
    display_options:
      title: 'Language Code'
      fields:
        language:
          id: language
          table: visitors
          field: language
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_language
          label: Language
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          code: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
        filters: true
        filter_groups: true
        footer: false
      display_description: ''
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: Language
          empty: false
          display_id: language_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
        - visitors_date_range
      tags: {  }
  language_table:
    id: language_table
    display_title: Language
    display_plugin: embed
    position: 4
    display_options:
      title: Language
      fields:
        language:
          id: language
          table: visitors
          field: language
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: Language
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
        filters: true
        filter_groups: true
        footer: false
      display_description: ''
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: 'Language Code'
          empty: false
          display_id: language_code_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
        - visitors_date_range
      tags: {  }
  local_hour_column:
    id: local_hour_column
    display_title: 'Local Column'
    display_plugin: embed
    position: 22
    display_options:
      fields:
        visitor_localtime:
          id: visitor_localtime
          table: visitors
          field: visitor_localtime
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_local_hour
          label: Hour
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitor_localtime:
          id: visitor_localtime
          table: visitors
          field: visitor_localtime
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: chart
        options:
          grouping: {  }
          chart_settings:
            library: chartjs
            type: column
            fields:
              label: visitor_localtime
              stacking: false
              data_providers:
                visitor_localtime:
                  enabled: false
                  color: '#000000'
                  weight: 2
                visitor_id:
                  enabled: true
                  color: '#0277bd'
                  weight: 2
            display:
              title: "Visitor's time"
              title_position: ''
              subtitle: ''
              data_labels: false
              data_markers: true
              legend_position: ''
              background: ''
              three_dimensional: 0
              polar: 0
              tooltips: true
              dimensions:
                width: ''
                width_units: ''
                height: ''
                height_units: ''
              gauge:
                max: ''
                min: ''
                green_from: ''
                green_to: ''
                yellow_from: ''
                yellow_to: ''
                red_from: ''
                red_to: ''
              color_changer: false
            xaxis:
              title: ''
              labels_rotation: '0'
            yaxis:
              title: ''
              min: ''
              max: ''
              prefix: ''
              suffix: ''
              decimal_count: '0'
              labels_rotation: '0'
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: table
          empty: false
          display_id: local_hour_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - visitors_date_range
      tags: {  }
  local_hour_table:
    id: local_hour_table
    display_title: 'Local Table'
    display_plugin: embed
    position: 22
    display_options:
      title: "Visitor's time"
      fields:
        visitor_localtime:
          id: visitor_localtime
          table: visitors
          field: visitor_localtime
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_local_hour
          label: Hour
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitor_localtime:
          id: visitor_localtime
          table: visitors
          field: visitor_localtime
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: table
        options:
          grouping: {  }
          row_class: ''
          default_row_class: true
          columns:
            visitor_localtime: visitor_localtime
            visitor_id: visitor_id
          default: '-1'
          info:
            visitor_localtime:
              sortable: false
              default_sort_order: asc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
            visitor_id:
              sortable: true
              default_sort_order: desc
              align: views-align-right
              separator: ''
              empty_column: false
              responsive: ''
          override: true
          sticky: true
          summary: ''
          empty_table: false
          caption: "Visitor's time"
          description: ''
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        title: false
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: chart
          empty: false
          display_id: local_hour_column
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
        - visitors_date_range
      tags: {  }
  monthly_column:
    id: monthly_column
    display_title: 'Monthly Column'
    display_plugin: embed
    position: 26
    display_options:
      fields:
        visitors_month:
          id: visitors_month
          table: visitors
          field: visitors_month
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_month
          label: Month
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_month:
          id: visitors_month
          table: visitors
          field: visitors_month
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: chart
        options:
          grouping: {  }
          chart_settings:
            library: chartjs
            type: column
            fields:
              label: visitors_month
              stacking: false
              data_providers:
                visitors_month:
                  enabled: false
                  color: '#000000'
                  weight: 2
                visitor_id:
                  enabled: true
                  color: '#0277bd'
                  weight: 2
            display:
              title: Monthly
              title_position: top
              subtitle: ''
              data_labels: false
              data_markers: true
              legend_position: ''
              background: ''
              three_dimensional: 0
              polar: 0
              tooltips: true
              dimensions:
                width: ''
                width_units: ''
                height: ''
                height_units: ''
              gauge:
                max: ''
                min: ''
                green_from: ''
                green_to: ''
                yellow_from: ''
                yellow_to: ''
                red_from: ''
                red_to: ''
              color_changer: false
            xaxis:
              title: ''
              labels_rotation: '0'
            yaxis:
              title: ''
              min: ''
              max: ''
              prefix: ''
              suffix: ''
              decimal_count: ''
              labels_rotation: '0'
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: table
          empty: false
          display_id: monthly_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - visitors_date_range
      tags: {  }
  monthly_table:
    id: monthly_table
    display_title: 'Monthly Table'
    display_plugin: embed
    position: 26
    display_options:
      title: Monthly
      fields:
        visitors_month:
          id: visitors_month
          table: visitors
          field: visitors_month
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_month
          label: Month
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_month:
          id: visitors_month
          table: visitors
          field: visitors_month
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: table
        options:
          grouping: {  }
          row_class: ''
          default_row_class: true
          columns:
            visitors_month: visitors_month
            visitor_id: visitor_id
          default: '-1'
          info:
            visitors_month:
              sortable: false
              default_sort_order: asc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
            visitor_id:
              sortable: true
              default_sort_order: desc
              align: views-align-right
              separator: ''
              empty_column: false
              responsive: ''
          override: true
          sticky: true
          summary: ''
          empty_table: false
          caption: Monthly
          description: ''
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        title: false
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: chart
          empty: false
          display_id: monthly_column
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
        - visitors_date_range
      tags: {  }
  os_family_table:
    id: os_family_table
    display_title: 'OS Family'
    display_plugin: embed
    position: 14
    display_options:
      title: 'OS Family'
      fields:
        config_os:
          id: config_os
          table: visitors
          field: config_os
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_operating_system
          label: 'Operating System families'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
        footer: false
      display_description: ''
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: 'Operating System versions'
          empty: false
          display_id: os_version_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
        - visitors_date_range
      tags: {  }
  os_version_table:
    id: os_version_table
    display_title: 'OS Version'
    display_plugin: embed
    position: 15
    display_options:
      title: 'OS Version'
      fields:
        config_os_version:
          id: config_os_version
          table: visitors
          field: config_os_version
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: 'OS version'
          exclude: true
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: Unknown
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        config_os:
          id: config_os
          table: visitors
          field: config_os
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_operating_system
          label: 'Operating System'
          exclude: false
          alter:
            alter_text: true
            text: '{{ config_os }}  {{ config_os_version }}'
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          icon: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        title: false
        fields: false
        footer: false
      display_description: ''
      footer:
        visitors_display_link:
          id: visitors_display_link
          table: visitors
          field: visitors_display_link
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_display_link
          label: 'Operating System families'
          empty: false
          display_id: os_family_table
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
        - visitors_date_range
      tags: {  }
  performance_daily_column:
    id: performance_daily_column
    display_title: 'Performance Daily'
    display_plugin: embed
    position: 21
    display_options:
      fields:
        pf_network:
          id: pf_network
          table: visitors
          field: pf_network
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: Network
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_server:
          id: pf_server
          table: visitors
          field: pf_server
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: Server
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_transfer:
          id: pf_transfer
          table: visitors
          field: pf_transfer
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: Transfer
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_dom_processing:
          id: pf_dom_processing
          table: visitors
          field: pf_dom_processing
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: 'DOM Processing'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_dom_complete:
          id: pf_dom_complete
          table: visitors
          field: pf_dom_complete
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: 'DOM Complete'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_on_load:
          id: pf_on_load
          table: visitors
          field: pf_on_load
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: 'On Load'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        visitors_day:
          id: visitors_day
          table: visitors
          field: visitors_day
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_day
          label: Day
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_day:
          id: visitors_day
          table: visitors
          field: visitors_day
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: chart
        options:
          grouping: {  }
          chart_settings:
            library: chartjs
            type: column
            fields:
              label: visitors_day
              stacking: true
              data_providers:
                pf_network:
                  enabled: true
                  color: '#0277bd'
                  weight: 7
                pf_server:
                  enabled: true
                  color: '#ff8f00'
                  weight: 7
                pf_transfer:
                  enabled: true
                  color: '#ad1457'
                  weight: 7
                pf_dom_processing:
                  enabled: true
                  color: '#6a1b9a'
                  weight: 7
                pf_dom_complete:
                  enabled: true
                  color: '#558b2f'
                  weight: 7
                pf_on_load:
                  enabled: true
                  color: '#00838f'
                  weight: 7
                visitors_day:
                  enabled: false
                  color: '#7643b6'
                  weight: 7
            display:
              title: ''
              title_position: ''
              subtitle: ''
              data_labels: false
              data_markers: true
              legend_position: bottom
              background: ''
              three_dimensional: 0
              polar: 0
              tooltips: true
              dimensions:
                width: ''
                width_units: ''
                height: ''
                height_units: ''
              gauge:
                max: ''
                min: ''
                green_from: ''
                green_to: ''
                yellow_from: ''
                yellow_to: ''
                red_from: ''
                red_to: ''
              color_changer: false
            xaxis:
              title: ''
              labels_rotation: '0'
            yaxis:
              title: ''
              min: ''
              max: ''
              prefix: ''
              suffix: ''
              decimal_count: ''
              labels_rotation: '0'
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        pager: false
        style: false
        row: false
        relationships: false
        fields: false
        sorts: false
      relationships: {  }
      display_description: ''
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - visitors_date_range
      tags: {  }
  performance_hourly_column:
    id: performance_hourly_column
    display_title: 'Performance Hourly'
    display_plugin: embed
    position: 21
    display_options:
      fields:
        pf_network:
          id: pf_network
          table: visitors
          field: pf_network
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: Network
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_server:
          id: pf_server
          table: visitors
          field: pf_server
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: Server
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_transfer:
          id: pf_transfer
          table: visitors
          field: pf_transfer
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: Transfer
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_dom_processing:
          id: pf_dom_processing
          table: visitors
          field: pf_dom_processing
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: 'DOM Processing'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_dom_complete:
          id: pf_dom_complete
          table: visitors
          field: pf_dom_complete
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: 'DOM Complete'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_on_load:
          id: pf_on_load
          table: visitors
          field: pf_on_load
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: 'On Load'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        visitors_hour:
          id: visitors_hour
          table: visitors
          field: visitors_hour
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_hour
          label: Hour
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_hour:
          id: visitors_hour
          table: visitors
          field: visitors_hour
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: chart
        options:
          grouping: {  }
          chart_settings:
            library: chartjs
            type: column
            fields:
              label: visitors_hour
              stacking: true
              data_providers:
                pf_network:
                  enabled: true
                  color: '#0277bd'
                  weight: 7
                pf_server:
                  enabled: true
                  color: '#ff8f00'
                  weight: 7
                pf_transfer:
                  enabled: true
                  color: '#ad1457'
                  weight: 7
                pf_dom_processing:
                  enabled: true
                  color: '#6a1b9a'
                  weight: 7
                pf_dom_complete:
                  enabled: true
                  color: '#558b2f'
                  weight: 7
                pf_on_load:
                  enabled: true
                  color: '#00838f'
                  weight: 7
                visitors_hour:
                  enabled: false
                  color: '#7643b6'
                  weight: 7
            display:
              title: ''
              title_position: ''
              subtitle: ''
              data_labels: false
              data_markers: true
              legend_position: bottom
              background: ''
              three_dimensional: 0
              polar: 0
              tooltips: true
              dimensions:
                width: ''
                width_units: ''
                height: ''
                height_units: ''
              gauge:
                max: ''
                min: ''
                green_from: ''
                green_to: ''
                yellow_from: ''
                yellow_to: ''
                red_from: ''
                red_to: ''
              color_changer: false
            xaxis:
              title: ''
              labels_rotation: '0'
            yaxis:
              title: ''
              min: ''
              max: ''
              prefix: ''
              suffix: ''
              decimal_count: ''
              labels_rotation: '0'
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        pager: false
        style: false
        row: false
        relationships: false
        fields: false
        sorts: false
      relationships: {  }
      display_description: ''
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - visitors_date_range
      tags: {  }
  performance_weekly_column:
    id: performance_weekly_column
    display_title: 'Performance Weekly'
    display_plugin: embed
    position: 21
    display_options:
      fields:
        pf_network:
          id: pf_network
          table: visitors
          field: pf_network
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: Network
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_server:
          id: pf_server
          table: visitors
          field: pf_server
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: Server
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_transfer:
          id: pf_transfer
          table: visitors
          field: pf_transfer
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: Transfer
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_dom_processing:
          id: pf_dom_processing
          table: visitors
          field: pf_dom_processing
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: 'DOM Processing'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_dom_complete:
          id: pf_dom_complete
          table: visitors
          field: pf_dom_complete
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: 'DOM Complete'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        pf_on_load:
          id: pf_on_load
          table: visitors
          field: pf_on_load
          relationship: none
          group_type: avg
          admin_label: ''
          plugin_id: numeric
          label: 'On Load'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        visitors_week:
          id: visitors_week
          table: visitors
          field: visitors_week
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_week
          label: Week
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_week:
          id: visitors_week
          table: visitors
          field: visitors_week
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: chart
        options:
          grouping: {  }
          chart_settings:
            library: chartjs
            type: column
            fields:
              label: visitors_week
              stacking: true
              data_providers:
                pf_network:
                  enabled: true
                  color: '#0277bd'
                  weight: 7
                pf_server:
                  enabled: true
                  color: '#ff8f00'
                  weight: 7
                pf_transfer:
                  enabled: true
                  color: '#ad1457'
                  weight: 7
                pf_dom_processing:
                  enabled: true
                  color: '#6a1b9a'
                  weight: 7
                pf_dom_complete:
                  enabled: true
                  color: '#558b2f'
                  weight: 7
                pf_on_load:
                  enabled: true
                  color: '#00838f'
                  weight: 7
                visitors_week:
                  enabled: false
                  color: '#7643b6'
                  weight: 7
            display:
              title: ''
              title_position: ''
              subtitle: ''
              data_labels: false
              data_markers: true
              legend_position: bottom
              background: ''
              three_dimensional: 0
              polar: 0
              tooltips: true
              dimensions:
                width: ''
                width_units: ''
                height: ''
                height_units: ''
              gauge:
                max: ''
                min: ''
                green_from: ''
                green_to: ''
                yellow_from: ''
                yellow_to: ''
                red_from: ''
                red_to: ''
              color_changer: false
            xaxis:
              title: ''
              labels_rotation: '0'
            yaxis:
              title: ''
              min: ''
              max: ''
              prefix: ''
              suffix: ''
              decimal_count: ''
              labels_rotation: '0'
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        pager: false
        style: false
        row: false
        relationships: false
        fields: false
        sorts: false
      relationships: {  }
      display_description: ''
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - visitors_date_range
      tags: {  }
  recent_view_table:
    id: recent_view_table
    display_title: 'Recent views'
    display_plugin: embed
    position: 19
    display_options:
      fields:
        visitors_id:
          id: visitors_id
          table: visitors
          field: visitors_id
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: numeric
          label: 'Visitors ID'
          exclude: true
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        visitors_url:
          id: visitors_url
          table: visitors
          field: visitors_url
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: URL
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitors_date_time:
          id: visitors_date_time
          table: visitors
          field: visitors_date_time
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: date
          label: 'Date Time'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          date_format: short
          custom_date_format: ''
          timezone: ''
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: Visitor
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        nothing:
          id: nothing
          table: views
          field: nothing
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: custom
          label: Operations
          exclude: false
          alter:
            alter_text: true
            text: details
            make_link: true
            path: 'internal:/visitors/hits/{{ visitors_id }}'
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: false
      pager:
        type: full
        options:
          offset: 0
          items_per_page: 10
          total_pages: null
          id: 0
          tags:
            next: ››
            previous: ‹‹
            first: '« First'
            last: 'Last »'
          expose:
            items_per_page: false
            items_per_page_label: 'Items per page'
            items_per_page_options: '5, 10, 25, 50'
            items_per_page_options_all: false
            items_per_page_options_all_label: '- All -'
            offset: false
            offset_label: Offset
          quantity: 9
      sorts: {  }
      arguments:
        route:
          id: route
          table: visitors
          field: route
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: string
          default_action: ignore
          exception:
            value: all
            title_enable: false
            title: All
          title_enable: false
          title: ''
          default_argument_type: fixed
          default_argument_options:
            argument: ''
          summary_options:
            base_path: ''
            count: true
            override: false
            items_per_page: 25
          summary:
            sort_order: asc
            number_of_records: 0
            format: default_summary
          specify_validation: false
          validate:
            type: none
            fail: 'not found'
          validate_options: {  }
          glossary: false
          limit: 0
          case: none
          path_case: none
          transform_dash: false
          break_phrase: false
        visitors_ip:
          id: visitors_ip
          table: visitors
          field: visitors_ip
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: string
          default_action: ignore
          exception:
            value: all
            title_enable: false
            title: All
          title_enable: false
          title: ''
          default_argument_type: fixed
          default_argument_options:
            argument: ''
          summary_options:
            base_path: ''
            count: true
            override: false
            items_per_page: 25
          summary:
            sort_order: asc
            number_of_records: 0
            format: default_summary
          specify_validation: false
          validate:
            type: none
            fail: 'not found'
          validate_options: {  }
          glossary: false
          limit: 0
          case: none
          path_case: none
          transform_dash: false
          break_phrase: false
        location_country:
          id: location_country
          table: visitors
          field: location_country
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: string
          default_action: ignore
          exception:
            value: all
            title_enable: false
            title: All
          title_enable: false
          title: ''
          default_argument_type: fixed
          default_argument_options:
            argument: ''
          summary_options:
            base_path: ''
            count: true
            override: false
            items_per_page: 25
          summary:
            sort_order: asc
            number_of_records: 0
            format: default_summary
          specify_validation: false
          validate:
            type: none
            fail: 'not found'
          validate_options: {  }
          glossary: false
          limit: 0
          case: upper
          path_case: none
          transform_dash: false
          break_phrase: false
      filters:
        bot:
          id: bot
          table: visitors
          field: bot
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: boolean
          operator: '!='
          value: '1'
          group: 1
          exposed: false
          expose:
            operator_id: ''
            label: ''
            description: ''
            use_operator: false
            operator: ''
            operator_limit_selection: false
            operator_list: {  }
            identifier: ''
            required: false
            remember: false
            multiple: false
            remember_roles:
              authenticated: authenticated
          is_grouped: false
          group_info:
            label: ''
            description: ''
            identifier: ''
            optional: true
            widget: select
            multiple: false
            remember: false
            default_group: All
            default_group_multiple: {  }
            group_items: {  }
        visitors_date_time:
          id: visitors_date_time
          table: visitors
          field: visitors_date_time
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_date
          operator: between
          value:
            min: to
            max: from
            value: ''
            type: global
          group: 1
          exposed: false
          expose:
            operator_id: ''
            label: ''
            description: ''
            use_operator: false
            operator: ''
            operator_limit_selection: false
            operator_list: {  }
            identifier: ''
            required: false
            remember: false
            multiple: false
            remember_roles:
              authenticated: authenticated
            min_placeholder: ''
            max_placeholder: ''
            placeholder: ''
          is_grouped: false
          group_info:
            label: ''
            description: ''
            identifier: ''
            optional: true
            widget: select
            multiple: false
            remember: false
            default_group: All
            default_group_multiple: {  }
            group_items: {  }
        visitors_path:
          id: visitors_path
          table: visitors
          field: visitors_path
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: string
          operator: starts
          value: ''
          group: 1
          exposed: true
          expose:
            operator_id: visitors_path_op
            label: Path
            description: ''
            use_operator: false
            operator: visitors_path_op
            operator_limit_selection: false
            operator_list: {  }
            identifier: visitors_path
            required: false
            remember: false
            multiple: false
            remember_roles:
              authenticated: authenticated
              anonymous: '0'
              content_editor: '0'
              administrator: '0'
            placeholder: ''
          is_grouped: false
          group_info:
            label: ''
            description: ''
            identifier: ''
            optional: true
            widget: select
            multiple: false
            remember: false
            default_group: All
            default_group_multiple: {  }
            group_items: {  }
      filter_groups:
        operator: AND
        groups:
          1: AND
      style:
        type: table
        options:
          grouping: {  }
          row_class: ''
          default_row_class: true
          columns:
            visitors_id: visitors_id
            visitors_url: visitors_url
            visitors_date_time: visitors_date_time
            visitor_id: visitor_id
            nothing: nothing
          default: visitors_date_time
          info:
            visitors_id:
              sortable: false
              default_sort_order: asc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
            visitors_url:
              sortable: false
              default_sort_order: asc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
            visitors_date_time:
              sortable: true
              default_sort_order: desc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
            visitor_id:
              sortable: false
              default_sort_order: desc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
            nothing:
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
          override: true
          sticky: true
          summary: ''
          empty_table: false
          caption: ''
          description: ''
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        pager: false
        group_by: false
        style: false
        row: false
        relationships: false
        fields: false
        sorts: false
        arguments: false
        filters: false
        filter_groups: false
        header: false
      relationships: {  }
      group_by: false
      display_description: ''
      header:
        result:
          id: result
          table: views
          field: result
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: result
          empty: false
          content: 'Displaying @start - @end of @total'
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url
        - url.query_args
        - visitors_date_range
      tags: {  }
  referrer_table:
    id: referrer_table
    display_title: 'Referrer views'
    display_plugin: embed
    position: 19
    display_options:
      fields:
        visitors_id:
          id: visitors_id
          table: visitors
          field: visitors_id
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: numeric
          label: 'Visitors ID'
          exclude: true
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          set_precision: false
          precision: 0
          decimal: .
          separator: ','
          format_plural: false
          format_plural_string: !!binary MQNAY291bnQ=
          prefix: ''
          suffix: ''
        visitors_referer:
          id: visitors_referer
          table: visitors
          field: visitors_referer
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: Referrer
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: '(Direct Entry)'
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitors_date_time:
          id: visitors_date_time
          table: visitors
          field: visitors_date_time
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: date
          label: 'Date Time'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
          date_format: fallback
          custom_date_format: ''
          timezone: ''
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: Visitor
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        nothing:
          id: nothing
          table: views
          field: nothing
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: custom
          label: Operations
          exclude: false
          alter:
            alter_text: true
            text: details
            make_link: true
            path: 'internal:/visitors/hits/{{ visitors_id }}'
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: false
      pager:
        type: full
        options:
          offset: 0
          items_per_page: 10
          total_pages: null
          id: 0
          tags:
            next: ››
            previous: ‹‹
            first: '« First'
            last: 'Last »'
          expose:
            items_per_page: false
            items_per_page_label: 'Items per page'
            items_per_page_options: '5, 10, 25, 50'
            items_per_page_options_all: false
            items_per_page_options_all_label: '- All -'
            offset: false
            offset_label: Offset
          quantity: 9
      sorts:
        visitors_id:
          id: visitors_id
          table: visitors
          field: visitors_id
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          order: DESC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      arguments:
        visitors_path:
          id: visitors_path
          table: visitors
          field: visitors_path
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: string
          default_action: default
          exception:
            value: all
            title_enable: false
            title: All
          title_enable: false
          title: ''
          default_argument_type: visitors_path
          default_argument_options:
            pop: 1
            route: false
          summary_options:
            base_path: ''
            count: true
            override: false
            items_per_page: 25
          summary:
            sort_order: asc
            number_of_records: 0
            format: default_summary
          specify_validation: false
          validate:
            type: none
            fail: 'not found'
          validate_options: {  }
          glossary: false
          limit: 0
          case: none
          path_case: none
          transform_dash: false
          break_phrase: false
      defaults:
        pager: false
        group_by: false
        relationships: false
        fields: false
        sorts: false
        arguments: false
        header: false
      relationships: {  }
      group_by: false
      display_description: ''
      header:
        result:
          id: result
          table: views
          field: result
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: result
          empty: false
          content: 'Displaying @start - @end of @total'
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url
        - url.path
        - url.query_args
        - visitors_date_range
      tags: {  }
  top_host_table:
    id: top_host_table
    display_title: 'Top Host'
    display_plugin: embed
    position: 18
    display_options:
      fields:
        visitors_ip:
          id: visitors_ip
          table: visitors
          field: visitors_ip
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: Host
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: true
            path: 'internal:/visitors/host/{{ visitors_ip }}'
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      defaults:
        fields: false
        header: false
      display_description: ''
      header:
        result:
          id: result
          table: views
          field: result
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: result
          empty: false
          content: 'Displaying @start - @end of @total'
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
        - visitors_date_range
      tags: {  }
  top_path_table:
    id: top_path_table
    display_title: 'Top Path'
    display_plugin: embed
    position: 16
    display_options:
      title: Path
      fields:
        visitors_path:
          id: visitors_path
          table: visitors
          field: visitors_path
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: Path
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      sorts: {  }
      defaults:
        title: false
        fields: false
        sorts: false
        header: false
      display_description: ''
      header:
        result:
          id: result
          table: views
          field: result
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: result
          empty: false
          content: 'Displaying @start - @end of @total'
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url.query_args
        - visitors_date_range
      tags: {  }
  top_route_table:
    id: top_route_table
    display_title: 'Top Route'
    display_plugin: embed
    position: 17
    display_options:
      fields:
        route:
          id: route
          table: visitors
          field: route
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: standard
          label: Route
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: true
            path: 'internal:/visitors/route/{{ route }}'
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      sorts: {  }
      filters:
        bot:
          id: bot
          table: visitors
          field: bot
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: boolean
          operator: '!='
          value: '1'
          group: 1
          exposed: false
          expose:
            operator_id: ''
            label: ''
            description: ''
            use_operator: false
            operator: ''
            operator_limit_selection: false
            operator_list: {  }
            identifier: ''
            required: false
            remember: false
            multiple: false
            remember_roles:
              authenticated: authenticated
          is_grouped: false
          group_info:
            label: ''
            description: ''
            identifier: ''
            optional: true
            widget: select
            multiple: false
            remember: false
            default_group: All
            default_group_multiple: {  }
            group_items: {  }
        visitors_date_time:
          id: visitors_date_time
          table: visitors
          field: visitors_date_time
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_date
          operator: between
          value:
            min: to
            max: from
            value: ''
            type: global
          group: 1
          exposed: false
          expose:
            operator_id: ''
            label: ''
            description: ''
            use_operator: false
            operator: ''
            operator_limit_selection: false
            operator_list: {  }
            identifier: ''
            required: false
            remember: false
            multiple: false
            remember_roles:
              authenticated: authenticated
            min_placeholder: ''
            max_placeholder: ''
            placeholder: ''
          is_grouped: false
          group_info:
            label: ''
            description: ''
            identifier: ''
            optional: true
            widget: select
            multiple: false
            remember: false
            default_group: All
            default_group_multiple: {  }
            group_items: {  }
        route:
          id: route
          table: visitors
          field: route
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: string
          operator: starts
          value: ''
          group: 1
          exposed: true
          expose:
            operator_id: route_op
            label: Route
            description: ''
            use_operator: false
            operator: route_op
            operator_limit_selection: false
            operator_list: {  }
            identifier: route
            required: false
            remember: false
            multiple: false
            remember_roles:
              authenticated: authenticated
              anonymous: '0'
              content_editor: '0'
              administrator: '0'
            placeholder: ''
          is_grouped: false
          group_info:
            label: ''
            description: ''
            identifier: ''
            optional: true
            widget: select
            multiple: false
            remember: false
            default_group: All
            default_group_multiple: {  }
            group_items: {  }
      filter_groups:
        operator: AND
        groups:
          1: AND
      style:
        type: table
        options:
          grouping: {  }
          row_class: ''
          default_row_class: true
          columns:
            route: route
            visitor_id: visitor_id
          default: visitor_id
          info:
            route:
              sortable: false
              default_sort_order: asc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
            visitor_id:
              sortable: true
              default_sort_order: desc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
          override: true
          sticky: true
          summary: ''
          empty_table: false
          caption: ''
          description: ''
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        style: false
        row: false
        fields: false
        sorts: false
        filters: false
        filter_groups: false
        header: false
      display_description: ''
      header:
        result:
          id: result
          table: views
          field: result
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: result
          empty: false
          content: 'Displaying @start - @end of @total'
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - url
        - url.query_args
        - visitors_date_range
      tags: {  }
  weekly_column:
    id: weekly_column
    display_title: 'Weekly Column'
    display_plugin: embed
    position: 26
    display_options:
      fields:
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitors_week:
          id: visitors_week
          table: visitors
          field: visitors_week
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_week
          label: Week
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_week:
          id: visitors_week
          table: visitors
          field: visitors_week
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: chart
        options:
          grouping: {  }
          chart_settings:
            library: chartjs
            type: column
            fields:
              label: visitors_week
              stacking: false
              data_providers:
                visitor_id:
                  enabled: true
                  color: '#0277bd'
                  weight: -1
                visitors_week:
                  enabled: false
                  color: '#0277bd'
                  weight: -2
            display:
              title: Weekly
              title_position: top
              subtitle: ''
              data_labels: false
              data_markers: true
              legend_position: ''
              background: ''
              three_dimensional: 0
              polar: 0
              tooltips: true
              dimensions:
                width: ''
                width_units: ''
                height: ''
                height_units: ''
              gauge:
                max: ''
                min: ''
                green_from: ''
                green_to: ''
                yellow_from: ''
                yellow_to: ''
                red_from: ''
                red_to: ''
              color_changer: false
            xaxis:
              title: ''
              labels_rotation: '0'
            yaxis:
              title: ''
              min: ''
              max: ''
              prefix: ''
              suffix: ''
              decimal_count: ''
              labels_rotation: '0'
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer: {  }
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - visitors_date_range
      tags: {  }
  weekly_table:
    id: weekly_table
    display_title: 'Weekly Table'
    display_plugin: embed
    position: 26
    display_options:
      fields:
        visitors_week:
          id: visitors_week
          table: visitors
          field: visitors_week
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_week
          label: Week
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
        visitor_id:
          id: visitor_id
          table: visitors
          field: visitor_id
          relationship: none
          group_type: count_distinct
          admin_label: ''
          plugin_id: standard
          label: 'Unique visitors'
          exclude: false
          alter:
            alter_text: false
            text: ''
            make_link: false
            path: ''
            absolute: false
            external: false
            replace_spaces: false
            path_case: none
            trim_whitespace: false
            alt: ''
            rel: ''
            link_class: ''
            prefix: ''
            suffix: ''
            target: ''
            nl2br: false
            max_length: 0
            word_boundary: true
            ellipsis: true
            more_link: false
            more_link_text: ''
            more_link_path: ''
            strip_tags: false
            trim: false
            preserve_tags: ''
            html: false
          element_type: ''
          element_class: ''
          element_label_type: ''
          element_label_class: ''
          element_label_colon: true
          element_wrapper_type: ''
          element_wrapper_class: ''
          element_default_classes: true
          empty: ''
          hide_empty: false
          empty_zero: false
          hide_alter_empty: true
      pager:
        type: none
        options:
          offset: 0
      sorts:
        visitors_week:
          id: visitors_week
          table: visitors
          field: visitors_week
          relationship: none
          group_type: group
          admin_label: ''
          plugin_id: visitors_timestamp
          order: ASC
          expose:
            label: ''
            field_identifier: ''
          exposed: false
      style:
        type: table
        options:
          grouping: {  }
          row_class: ''
          default_row_class: true
          columns:
            visitor_id: visitor_id
            visitors_week: visitors_week
          default: '-1'
          info:
            visitor_id:
              sortable: false
              default_sort_order: asc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
            visitors_week:
              sortable: false
              default_sort_order: asc
              align: ''
              separator: ''
              empty_column: false
              responsive: ''
          override: true
          sticky: false
          summary: ''
          empty_table: false
          caption: ''
          description: ''
      row:
        type: fields
        options:
          default_field_elements: true
          inline: {  }
          separator: ''
          hide_empty: false
      defaults:
        pager: false
        style: false
        row: false
        fields: false
        sorts: false
        header: false
        footer: false
      display_description: ''
      header: {  }
      footer: {  }
      display_extenders: {  }
    cache_metadata:
      max-age: -1
      contexts:
        - 'languages:language_interface'
        - visitors_date_range
      tags: {  }
YAML;
    $view_array = Yaml::parse($yaml);
    return $view_array;
  }

}
