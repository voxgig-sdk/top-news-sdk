# frozen_string_literal: true

# Typed models for the TopNews SDK.
#
# GENERATED from the API model: main.kit.entity.<e>.fields[] and per-op
# params (op.<name>.points[].args.params[]). Member types come from the
# canonical type sentinels via @voxgig/sdkgen canonToType (source of truth:
# @voxgig/apidef VALID_CANON). Ruby types are unenforced; these YARD
# annotations document the shapes. Do not edit by hand.

# TopNew entity data model.
#
# @!attribute [rw] news
#   @return [Array]
TopNew = Struct.new(
  :news,
  keyword_init: true
)

# Request payload for TopNew#list.
#
# @!attribute [rw] news
#   @return [Array, nil]
TopNewListMatch = Struct.new(
  :news,
  keyword_init: true
)

